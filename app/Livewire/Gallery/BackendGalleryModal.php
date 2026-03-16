<?php

namespace App\Livewire\Gallery;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Storage;
use App\Models\GalleryPhoto;
use App\Models\Project;

class BackendGalleryModal extends Component
{
    use WithFileUploads;

    public $itemId, $project_id, $caption, $image, $currentImage, $sort_order = 0;
    public $status = 'draft';
    public $projects = [];

    protected $rules = [
        'project_id' => 'required|exists:projects,id',
        'caption'    => 'nullable|max:255',
        'image'      => 'nullable|image|max:4096',
        'sort_order' => 'nullable|integer|min:0',
        'status'     => 'required|in:published,draft',
    ];

    protected $messages = [
        'project_id.required' => 'Please select a project.',
        'project_id.exists'   => 'The selected project is invalid.',
        'image.image'         => 'The file must be a valid image.',
        'image.max'           => 'Image may not be greater than 4MB.',
        'status.required'     => 'Status is required.',
        'status.in'           => 'Invalid status.',
    ];

    public function mount()
    {
        $this->projects = Project::where('status', 'published')->orderBy('title')->get();
    }

    public function store()
    {
        $this->rules['image'] = 'required|image|max:4096';
        $this->validate();

        $last  = GalleryPhoto::latest()->first();
        $newId = $last ? $last->id + 1 : 1;
        $ext   = $this->image->getClientOriginalExtension();
        $filename  = 'gallery_' . $newId . '_' . time() . '.' . $ext;
        $imagePath = 'gallery/' . $filename;
        $this->image->storePubliclyAs('gallery', $filename, 'public');

        GalleryPhoto::create([
            'project_id' => $this->project_id,
            'caption'    => $this->caption,
            'image'      => $imagePath,
            'sort_order' => (int) ($this->sort_order ?? 0),
            'status'     => $this->status,
        ]);

        session()->flash('message', 'Photo added successfully.');
        $this->resetAll();
        $this->dispatch('close-modal', 'addGalleryModal');
        $this->dispatch('gallery-updated');
    }

    #[On('editGalleryItem')]
    public function editItem($id)
    {
        $item = GalleryPhoto::findOrFail($id);
        $this->itemId       = $item->id;
        $this->project_id   = $item->project_id;
        $this->caption      = $item->caption;
        $this->sort_order   = $item->sort_order;
        $this->status       = $item->status;
        $this->currentImage = $item->image;
        $this->dispatch('open-modal', 'editGalleryModal');
    }

    public function update()
    {
        $this->validate();

        $item = GalleryPhoto::findOrFail($this->itemId);
        $imagePath = $item->image;

        if ($this->image) {
            if ($item->image && Storage::disk('public')->exists($item->image)) {
                Storage::disk('public')->delete($item->image);
            }
            $ext      = $this->image->getClientOriginalExtension();
            $filename = 'gallery_' . $item->id . '_' . time() . '.' . $ext;
            $imagePath = 'gallery/' . $filename;
            $this->image->storePubliclyAs('gallery', $filename, 'public');
        }

        $item->update([
            'project_id' => $this->project_id,
            'caption'    => $this->caption,
            'image'      => $imagePath,
            'sort_order' => (int) ($this->sort_order ?? 0),
            'status'     => $this->status,
        ]);

        session()->flash('message', 'Photo updated successfully.');
        $this->resetAll();
        $this->dispatch('close-modal', 'editGalleryModal');
        $this->dispatch('gallery-updated');
    }

    #[On('deleteGalleryItem')]
    public function deleteItem($id)
    {
        $item = GalleryPhoto::findOrFail($id);
        if ($item->image && Storage::disk('public')->exists($item->image)) {
            Storage::disk('public')->delete($item->image);
        }
        $item->delete();
        session()->flash('message', 'Photo deleted successfully.');
        $this->dispatch('gallery-updated');
    }

    public function resetAll()
    {
        $this->itemId       = null;
        $this->project_id   = '';
        $this->caption      = null;
        $this->image        = null;
        $this->currentImage = null;
        $this->sort_order   = 0;
        $this->status       = 'draft';
    }

    public function render()
    {
        return view('livewire.gallery.backend-gallery-modal');
    }
}
