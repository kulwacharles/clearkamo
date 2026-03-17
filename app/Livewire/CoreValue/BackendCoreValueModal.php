<?php

namespace App\Livewire\CoreValue;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Storage;
use App\Models\CoreValue;

class BackendCoreValueModal extends Component
{
    use WithFileUploads;

    public $itemId, $title, $summary, $details, $icon, $image, $currentImage, $sort_order = 0;
    public $status = 'draft';

    // Allow up to 10 MB images for better resolution
    protected $rules = [
        'title'      => 'required|min:3|max:255',
        'summary'    => 'required|min:3|max:500',
        'details'    => 'nullable|min:3',
        'icon'       => 'nullable|max:100',
        'image'      => 'nullable|image|max:20480',
        'sort_order' => 'nullable|integer|min:0',
        'status'     => 'required|in:published,draft',
    ];

    protected $messages = [
        'title.required'   => 'Title is required.',
        'summary.required' => 'Summary is required.',
        'image.image'      => 'The file must be a valid image.',
        'image.max'        => 'Image may not be greater than 10MB.',
        'status.required'  => 'Status is required.',
        'status.in'        => 'Invalid status selected.',
    ];

    public function store()
    {
        $this->validate();

        $imagePath = null;
        if ($this->image) {
            $last  = CoreValue::latest()->first();
            $newId = $last ? $last->id + 1 : 1;
            $ext   = $this->image->getClientOriginalExtension();
            $filename  = 'core_value_' . $newId . '.' . $ext;
            $imagePath = 'core-values/' . $filename;
            $this->image->storePubliclyAs('core-values', $filename, 'public');
        }

        CoreValue::create([
            'title'      => $this->title,
            'summary'    => $this->summary,
            'details'    => $this->details,
            'icon'       => $this->icon ?: 'fa-star',
            'image'      => $imagePath,
            'sort_order' => (int) ($this->sort_order ?? 0),
            'status'     => $this->status,
        ]);

        session()->flash('message', 'Core Value added successfully.');
        $this->resetAll();
        $this->dispatch('close-modal', 'addCoreValueModal');
        $this->dispatch('core-value-updated');
    }

    #[On('editCoreValueItem')]
    public function editItem($id)
    {
        $item = CoreValue::findOrFail($id);
        $this->itemId       = $item->id;
        $this->title        = $item->title;
        $this->summary      = $item->summary;
        $this->details      = $item->details;
        $this->icon         = $item->icon;
        $this->sort_order   = $item->sort_order;
        $this->status       = $item->status;
        $this->currentImage = $item->image;
        $this->dispatch('open-modal', 'editCoreValueModal');
    }

    public function update()
    {
        $this->validate();

        $item = CoreValue::findOrFail($this->itemId);
        $imagePath = $item->image;

        if ($this->image) {
            if ($item->image && Storage::disk('public')->exists($item->image)) {
                Storage::disk('public')->delete($item->image);
            }
            $ext      = $this->image->getClientOriginalExtension();
            $filename = 'core_value_' . $item->id . '.' . $ext;
            $imagePath = 'core-values/' . $filename;
            $this->image->storePubliclyAs('core-values', $filename, 'public');
        }

        $item->update([
            'title'      => $this->title,
            'summary'    => $this->summary,
            'details'    => $this->details,
            'icon'       => $this->icon ?: 'fa-star',
            'image'      => $imagePath,
            'sort_order' => (int) ($this->sort_order ?? 0),
            'status'     => $this->status,
        ]);

        session()->flash('message', 'Core Value updated successfully.');
        $this->resetAll();
        $this->dispatch('close-modal', 'editCoreValueModal');
        $this->dispatch('core-value-updated');
    }

    #[On('deleteCoreValueItem')]
    public function deleteItem($id)
    {
        $item = CoreValue::findOrFail($id);
        if ($item->image && Storage::disk('public')->exists($item->image)) {
            Storage::disk('public')->delete($item->image);
        }
        $item->delete();
        session()->flash('message', 'Core Value deleted successfully.');
        $this->dispatch('core-value-updated');
    }

    public function resetAll()
    {
        $this->itemId       = null;
        $this->title        = null;
        $this->summary      = null;
        $this->details      = null;
        $this->icon         = null;
        $this->image        = null;
        $this->currentImage = null;
        $this->sort_order   = 0;
        $this->status       = 'draft';
    }

    public function render()
    {
        return view('livewire.core-value.backend-core-value-modal');
    }
}
