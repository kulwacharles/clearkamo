<?php

namespace App\Livewire\Publication;

use Livewire\Component;
use App\Models\Publication;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class PublicationsModal extends Component
{
    use WithFileUploads;

    public $title, $category, $description, $image, $imagePath, $pubId,$published_date;
    public $status = 'draft';
    public $currentImage;
    
    // View modal properties
    public $viewTitle, $viewCategory, $viewDescription, $viewStatus, $viewImage,$viewPublishedDate;

    protected $rules = [
        'title'       => 'required|min:3|max:255',
        'published_date' => 'required|min:3|max:255',
        'category'    => 'required|min:3|max:255',
        'description' => 'required|min:10',
        'image'       => 'nullable|image|max:2048',
        'status'      => 'required|in:published,draft,archived',
    ];

    protected $messages = [
        'title.required'       => 'The Title is required.',
        'title.min'            => 'The Title must be at least 3 characters.',
        'category.required'    => 'The Category is required.',
        'description.required' => 'The Description is required.',
        'description.min'      => 'The Description must be at least 10 characters.',
        'image.image'          => 'The Image must be valid.',
        'image.max'            => 'The Image may not be greater than 2MB.',
        'status.required'      => 'The Status is required.',
        'status.in'            => 'The selected Status is invalid.',
        'published_date'       => 'Publish date required'
    ];

    public function store()
    {
        $this->validate();

        $imagePath = null;

        // Handle image upload
        if ($this->image) {
            $last = Publication::latest()->first();
            $newId = $last ? $last->id + 1 : 1;

            $extension = $this->image->getClientOriginalExtension();
            $filename  = 'clear_Kamo_' . $newId . '.' . $extension;
            $imagePath = 'publications/' . $filename;

            $this->image->storePubliclyAs('publications', $filename, 'public');
        }

        // Create blog post
        $pub = new Publication;          
        $pub->title       = $this->title;
        $pub->publication_category    = $this->category;
        $pub->description = $this->description;
        $pub->image       = $imagePath;
        $pub->status      = $this->status;

        $result = $pub->save();
        
        if($result){
            session()->flash('message', 'Blog Post saved successfully.'); 
            $this->resetAll();
            $this->dispatch('reset-ckeditor');
            $this->dispatch('close-modal', 'addBlogModal');
            $this->dispatch('pub-updated');
        }
    }

    // Handle edit event from blog list
    public function editPub($pubId)
    {
        $pub = Publication::findOrFail($pubId);
        
        $this->pubId = $pub->id;
        $this->title = $pub->title;
        $this->category = $pub->publication_category;
        $this->description = $pub->description;
        $this->status = $pub->status;
        $this->currentImage = $pub->image;
        $this->published_date = $pub->published_date;
        $this->dispatch('set-ckeditor-content', content: $pub->description);
        $this->dispatch('open-modal', 'editPubModal');
    }

    public function update()
    {
        $this->validate();

        $pub = Publication::findOrFail($this->pubId);
        $imagePath = $pub->image;

        // Handle image upload if new image is provided
        if ($this->image) {
            // Delete old image if exists
            if ($pub->image && Storage::disk('public')->exists($pub->image)) {
                Storage::disk('public')->delete($pub->image);
            }

            $extension = $this->image->getClientOriginalExtension();
            $filename  = 'clear_Kamo_' . $pub->id . '.' . $extension;
            $imagePath = 'publications/' . $filename;

            $this->image->storePubliclyAs('publications', $filename, 'public');
        }

        // Update blog post
        $pub->title       = $this->title;
        $pub->publication_category    = $this->category;
        $pub->description = $this->description;
        $pub->published_date = $this->published_date;
        $pub->image       = $imagePath;
        $pub->status      = $this->status;

        $result = $pub->save();
        
        if($result){
            session()->flash('message', 'Publication Post updated successfully.'); 
            $this->resetAll();
            $this->dispatch('close-modal', 'editPubModal');
            $this->dispatch('pub-updated');
        }
    }

    // Handle view event from blog list
    public function viewPub($pubId)
    {
        $pub = Publication::findOrFail($pubId);
        
        $this->viewTitle = $pub->title;
        $this->viewCategory = $pub->publication_category;
        $this->viewDescription = $pub->description;
        $this->viewStatus = $pub->status;
        $this->viewImage = $pub->image;
        $this->viewPublishedDate = $pub->published_date;
        $this->dispatch('open-modal', 'viewPubModal');
    }

    // Handle delete event from blog list
    public function deletePub($pubId)
    {
        $pub = Publication::findOrFail($pubId);
        
        // Delete image if exists
        if ($pub->image && Storage::disk('public')->exists($pub->image)) {
            Storage::disk('public')->delete($pub->image);
        }
        
        $pub->delete();
        
        session()->flash('message', 'Publication Post deleted successfully.');
        $this->dispatch('pub-updated');
    }

    public function resetAll()
    {
        $this->title       = null;
        $this->category    = null;
        $this->description = '';
        $this->image       = null;
        $this->imagePath   = null;
        $this->pubId      = null;
        $this->status      = 'draft';
        $this->currentImage = null;
    }

    public function render()
    {
        return view('livewire.publication.Publications-modal');
    }
}
