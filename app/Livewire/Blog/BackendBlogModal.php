<?php

namespace App\Livewire\Blog;

use Livewire\Component;
use App\Models\Blog;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class BackendBlogModal extends Component
{
    use WithFileUploads;

    public $title, $category, $description, $image, $imagePath, $blogId;
    public $status = 'draft';
    public $currentImage;
    
    // View modal properties
    public $viewTitle, $viewCategory, $viewDescription, $viewStatus, $viewImage;

    protected $rules = [
        'title'       => 'required|min:3|max:255',
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
    ];

    public function store()
    {
        $this->validate();

        $imagePath = null;

        // Handle image upload
        if ($this->image) {
            $last = Blog::latest()->first();
            $newId = $last ? $last->id + 1 : 1;

            $extension = $this->image->getClientOriginalExtension();
            $filename  = 'clear_Kamo_' . $newId . '.' . $extension;
            $imagePath = 'blogs/' . $filename;

            $this->image->storePubliclyAs('blogs', $filename, 'public');
        }

        // Create blog post
        $blog = new Blog;          
        $blog->title       = $this->title;
        $blog->category    = $this->category;
        $blog->description = $this->description;
        $blog->image       = $imagePath;
        $blog->status      = $this->status;

        $result = $blog->save();
        
        if($result){
            session()->flash('message', 'Blog Post saved successfully.'); 
            $this->resetAll();
            $this->dispatch('reset-ckeditor');
            $this->dispatch('close-modal', 'addBlogModal');
            $this->dispatch('blog-updated');
        }
    }

    // Handle edit event from blog list
    public function editBlog($blogId)
    {
        $blog = Blog::findOrFail($blogId);
        
        $this->blogId = $blog->id;
        $this->title = $blog->title;
        $this->category = $blog->category;
        $this->description = $blog->description;
        $this->status = $blog->status;
        $this->currentImage = $blog->image;
        
        $this->dispatch('set-ckeditor-content', content: $blog->description);
        $this->dispatch('open-modal', 'editBlogModal');
    }

    public function update()
    {
        $this->validate();

        $blog = Blog::findOrFail($this->blogId);
        $imagePath = $blog->image;

        // Handle image upload if new image is provided
        if ($this->image) {
            // Delete old image if exists
            if ($blog->image && Storage::disk('public')->exists($blog->image)) {
                Storage::disk('public')->delete($blog->image);
            }

            $extension = $this->image->getClientOriginalExtension();
            $filename  = 'clear_Kamo_' . $blog->id . '.' . $extension;
            $imagePath = 'blogs/' . $filename;

            $this->image->storePubliclyAs('blogs', $filename, 'public');
        }

        // Update blog post
        $blog->title       = $this->title;
        $blog->category    = $this->category;
        $blog->description = $this->description;
        $blog->image       = $imagePath;
        $blog->status      = $this->status;

        $result = $blog->save();
        
        if($result){
            session()->flash('message', 'Blog Post updated successfully.'); 
            $this->resetAll();
            $this->dispatch('close-modal', 'editBlogModal');
            $this->dispatch('blog-updated');
        }
    }

    // Handle view event from blog list
    public function viewBlog($blogId)
    {
        $blog = Blog::findOrFail($blogId);
        
        $this->viewTitle = $blog->title;
        $this->viewCategory = $blog->category;
        $this->viewDescription = $blog->description;
        $this->viewStatus = $blog->status;
        $this->viewImage = $blog->image;
        
        $this->dispatch('open-modal', 'viewBlogModal');
    }

    // Handle delete event from blog list
    public function deleteBlog($blogId)
    {
        $blog = Blog::findOrFail($blogId);
        
        // Delete image if exists
        if ($blog->image && Storage::disk('public')->exists($blog->image)) {
            Storage::disk('public')->delete($blog->image);
        }
        
        $blog->delete();
        
        session()->flash('message', 'Blog Post deleted successfully.');
        $this->dispatch('blog-updated');
    }

    public function resetAll()
    {
        $this->title       = null;
        $this->category    = null;
        $this->description = '';
        $this->image       = null;
        $this->imagePath   = null;
        $this->blogId      = null;
        $this->status      = 'draft';
        $this->currentImage = null;
    }

    public function render()
    {
        return view('livewire.blog.backend-blog-modal');
    }
}