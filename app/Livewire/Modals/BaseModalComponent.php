<?php

namespace App\Livewire\Modals;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

abstract class BaseModalComponent extends Component
{
    use WithFileUploads;

    // Basic fields
    public $title, $description, $image, $recordId;
    public $status = 'draft';
    public $currentImage;
    public $viewData = [];
    public $customFields = [];
    public $modalType;

    // Standard Livewire validation
    protected $rules = [];
    protected $messages = [];

    // Field configuration
    protected $fieldConfig = [
        'basic' => ['title', 'description', 'image', 'status'],
        'custom' => [],
        'validation_rules' => [],
        'validation_messages' => []
    ];

    protected $listeners = [
        'edit-record' => 'editRecord',
        'view-record' => 'viewRecord',
        'deleteRecord' => 'deleteRecord'
    ];

    // Abstract methods
    abstract protected function getModelClass();
    abstract protected function getStoragePath();
    abstract protected function getFilenamePrefix();
    abstract protected function getModalType();

    public function mount()
    {
        $this->modalType = $this->getModalType();
        $this->initializeCustomFields();
        $this->initializeValidation();
    }

    protected function initializeValidation()
    {
        $defaultRules = [
            'title' => 'required|min:3|max:255',
            'description' => 'required|min:10',
            'image' => 'nullable|image|max:2048',
            'status' => 'required|in:published,draft,archived',
        ];

        $defaultMessages = [
            'title.required' => 'The Title is required.',
            'description.required' => 'The Description is required.',
        ];

        $this->rules = array_merge($defaultRules, $this->fieldConfig['validation_rules']);
        $this->messages = array_merge($defaultMessages, $this->fieldConfig['validation_messages']);
    }

    protected function initializeCustomFields()
    {
        foreach ($this->fieldConfig['custom'] as $field => $default) {
            $this->customFields[$field] = $default;
        }
    }

 public function editRecord($recordId)
{
    try {
        $modelClass = $this->getModelClass();
        $record = $modelClass::findOrFail($recordId);
        
        // Reset first
        $this->resetAll();
        
        // Set data
        $this->recordId = $record->id;
        $this->title = $record->title;
        $this->description = $record->description; // This is CRITICAL
        $this->status = $record->status;
        $this->currentImage = $record->image;
        
        // Set custom fields
        foreach ($this->fieldConfig['custom'] as $field => $default) {
            if (isset($record->$field)) {
                $this->customFields[$field] = $record->$field;
            }
        }
        
        // Log for debugging
        \Log::info("Editing {$this->modalType} - ID: {$recordId}, Content: " . substr($this->description, 0, 100));
        
        // Open modal first
        $this->dispatch('open-modal', $this->modalType . 'EditModal');
        
        // Then set CKEditor content after a delay
        $this->dispatch('set-ckeditor-content', 
            type: $this->modalType,
            content: $this->description
        );
        
    } catch (\Exception $e) {
        session()->flash('error', 'Error loading record: ' . $e->getMessage());
    }
}

public function resetAll()
{
    $this->reset([
        'title', 'description', 'image', 'recordId', 
        'status', 'currentImage', 'viewData'
    ]);
    
    // Reset custom fields
    foreach ($this->fieldConfig['custom'] as $field => $default) {
        $this->customFields[$field] = $default;
    }
}
    public function viewRecord($recordId)
    {
        $modelClass = $this->getModelClass();
        $record = $modelClass::findOrFail($recordId);
        
        $this->viewData = [
            'title' => $record->title,
            'description' => $record->description,
            'status' => $record->status,
            'image' => $record->image,
        ];
        
        foreach ($this->fieldConfig['custom'] as $field => $default) {
            if (isset($record->$field)) {
                $this->viewData[$field] = $record->$field;
            }
        }
        
        $this->dispatch('open-modal', $this->modalType . 'ViewModal');
    }

    public function deleteRecord($recordId)
    {
        $modelClass = $this->getModelClass();
        $record = $modelClass::findOrFail($recordId);
        
        if ($record->image && Storage::disk('public')->exists($record->image)) {
            Storage::disk('public')->delete($record->image);
        }
        
        $record->delete();
        
        session()->flash('message', ucfirst($this->modalType) . ' deleted successfully.');
        $this->dispatch('record-updated');
    }

    public function store()
    {
        $this->validate();

        $imagePath = $this->handleImageUpload();

        $modelClass = $this->getModelClass();
        $record = new $modelClass;
        $record->title = $this->title;
        $record->description = $this->description;
        $record->image = $imagePath;
        $record->status = $this->status;
        
        foreach ($this->fieldConfig['custom'] as $field => $default) {
            if (isset($this->customFields[$field])) {
                $record->$field = $this->customFields[$field];
            }
        }

        $record->save();
        
        session()->flash('message', ucfirst($this->modalType) . ' saved successfully.'); 
        $this->resetAll();
        $this->dispatch('reset-ckeditor');
        $this->dispatch('close-modal', $this->modalType . 'AddModal');
        $this->dispatch('record-updated');
    }

    public function update()
    {
        $this->validate();

        $modelClass = $this->getModelClass();
        $record = $modelClass::findOrFail($this->recordId);
        $imagePath = $this->handleImageUpload($record);

        $record->title = $this->title;
        $record->description = $this->description;
        $record->image = $imagePath;
        $record->status = $this->status;
        
        foreach ($this->fieldConfig['custom'] as $field => $default) {
            if (isset($this->customFields[$field])) {
                $record->$field = $this->customFields[$field];
            }
        }

        $record->save();
        
        session()->flash('message', ucfirst($this->modalType) . ' updated successfully.'); 
        $this->resetAll();
        $this->dispatch('close-modal', $this->modalType . 'EditModal');
        $this->dispatch('record-updated');
    }

    protected function handleImageUpload($existingRecord = null)
    {
        if (!$this->image) {
            return $existingRecord ? $existingRecord->image : null;
        }

        if ($existingRecord && $existingRecord->image) {
            Storage::disk('public')->delete($existingRecord->image);
        }

        if ($existingRecord) {
            $id = $existingRecord->id;
        } else {
            $modelClass = $this->getModelClass();
            $last = $modelClass::latest()->first();
            $id = $last ? $last->id + 1 : 1;
        }

        $extension = $this->image->getClientOriginalExtension();
        $filename = $this->getFilenamePrefix() . '_' . $id . '.' . $extension;
        $imagePath = $this->getStoragePath() . '/' . $filename;

        $this->image->storePubliclyAs($this->getStoragePath(), $filename, 'public');

        return $imagePath;
    }



    public function render()
    {
        return view('livewire.modals.base-modal-component');
    }
}