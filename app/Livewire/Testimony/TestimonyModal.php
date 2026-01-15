<?php

namespace App\Livewire\Testimony;

use Livewire\Component;
use App\Models\Testimony;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
class TestimonyModal extends Component
{
    use WithFileUploads;

    public $name, $category, $description, $image, $imagePath, $blogId, $PostDate,$DueDate,$position;
    public $status = 'draft';
    public $currentImage;
    
    // View modal properties
    public $viewName,  $viewDescription, $viewStatus, $viewImage,$viewPosition;

    protected $rules = [
        'name'       => 'required|min:3|max:255',
        'description' => 'required|min:10',
        'image'       => 'nullable|image|max:2048',
        'status'      => 'required|in:published,draft,archived',
    ];

    protected $messages = [
        'name.required'       => 'The Title is required.',
        'name.min'            => 'The Title must be at least 3 characters.',
        'category.required'    => 'The Category is required.',
        'description.required' => 'The Description is required.',
        'description.min'      => 'The Description must be at least 10 characters.',
        'image.image'          => 'The Image must be valid.',
        'image.max'            => 'The Image may not be greater than 2MB.',
        'status.required'      => 'The Status is required.',
        'status.in'            => 'The selected Status is invalid.',
    ];

    public function store()
    {
        $this->validate();

        $imagePath = null;

        // Handle image upload
        if ($this->image) {
            $last = Testimony::latest()->first();
            $newId = $last ? $last->id + 1 : 1;

            $extension = $this->image->getClientOriginalExtension();
            $filename  = 'testimony_' . $newId . '.' . $extension;
            $imagePath = 'testimony/' . $filename;

            $this->image->storePubliclyAs('testimony', $filename, 'public');
        }

        // Create blog post
        $blog = new Testimony;          
        $blog->name       = $this->name;
        $blog->description = $this->description;
        $blog->image       = $imagePath;
        $blog->status      = $this->status;
        $blog->position   = $this->position; 
        $result = $blog->save();
        
        if($result){
            session()->flash('message', 'Vacancy saved successfully.'); 
            $this->resetAll();
            $this->dispatch('reset-ckeditor');
            $this->dispatch('close-modal', 'addBlogModal');
            $this->dispatch('blog-updated');
        }
    }

    // Handle edit event from blog list
    public function editBlog($blogId)
    {
        $blog = Testimony::findOrFail($blogId);
        
        $this->blogId = $blog->id;
        $this->name = $blog->name;
        $this->description = $blog->description;
        $this->status = $blog->status;
        $this->currentImage = $blog->image;
        $this->position = $blog->position;
        $this->dispatch('set-ckeditor-content', content: $blog->description);
        $this->dispatch('open-modal', 'editBlogModal');
    }

    public function update()
    {
        $this->validate();

        $blog = Testimony::findOrFail($this->blogId);
        $imagePath = $blog->image;

        // Handle image upload if new image is provided
        if ($this->image) {
            // Delete old image if exists
            if ($blog->image && Storage::disk('public')->exists($blog->image)) {
                Storage::disk('public')->delete($blog->image);
            }

            $extension = $this->image->getClientOriginalExtension();
            $filename  = 'testimony_' . $blog->id . '.' . $extension;
            $imagePath = 'testimony/' . $filename;

            $this->image->storePubliclyAs('testimony', $filename, 'public');
        }

        // Update blog post
        $blog->name       = $this->name;
        $blog->description = $this->description;
        $blog->image       = $imagePath;
        $blog->status      = $this->status;
        $blog->position   = $this->position;
        $result = $blog->save();
        
        if($result){
            session()->flash('message', 'Testimony Post updated successfully.'); 
            $this->resetAll();
            $this->dispatch('close-modal', 'editBlogModal');
            $this->dispatch('blog-updated');
        }
    }

    // Handle view event from blog list
    public function viewBlog($blogId)
    {
        $blog = Testimony::findOrFail($blogId);
        
        $this->viewName = $blog->name;
        $this->viewDescription = $blog->description;
        $this->viewStatus = $blog->status;
        $this->viewPosition = $blog->position;
        $this->viewImage = $blog->image;
        
        $this->dispatch('open-modal', 'viewBlogModal');
    }

    // Handle delete event from blog list
    public function deleteBlog($blogId)
    {
        $blog = Testimony::findOrFail($blogId);
        
        // Delete image if exists
        if ($blog->image && Storage::disk('public')->exists($blog->image)) {
            Storage::disk('public')->delete($blog->image);
        }
        
        $blog->delete();
        
        session()->flash('message', 'Testimony Post deleted successfully.');
        $this->dispatch('blog-updated');
    }

    public function resetAll()
    {
        $this->name       = null;

        $this->description = '';
        $this->image       = null;
        $this->imagePath   = null;
        $this->blogId      = null;
        $this->status      = 'draft';
        $this->currentImage = null;
        $this->position = null;
    }


    public function render()
    {
        return view('livewire.testimony.testimony-modal');
    }
}
