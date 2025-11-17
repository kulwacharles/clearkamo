<?php

namespace App\Livewire\Team;

use Livewire\Component;
use App\Models\Blog;
use App\Models\Team;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
class BackendTeamModal extends Component
{
    use WithFileUploads;

    public $name, $salute, $description, $image, $imagePath, $blogId,$email,$linkedin,$instagram,$twitter,$facebook,$youtube,$position;
    public $status = 'draft';
    public $currentImage;
    
    // View modal properties
    public $viewName, $viewCategory, $viewDescription, $viewStatus, $viewImage,$viewRmail,$viewLinkedin,$viewInstagram,$viewTwitter,$viewFacebook,$viewYoutube,$viewPosition;

    protected $rules = [
        'name'       => 'required|min:3|max:255',
        'salute'    => 'required|min:3|max:255',
        'description' => 'required|min:10',
        'image'       => 'nullable|image|max:2048',
        'status'      => 'required|in:published,draft,archived',
    ];

    protected $messages = [
        'name.required'       => 'The Name is required.',
        'name.min'            => 'The Title must be at least 3 characters.',
        'salute.required'      => 'The Salutation is required.',
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
            $last = Team::latest()->first();
            $newId = $last ? $last->id + 1 : 1;

            $extension = $this->image->getClientOriginalExtension();
            $filename  = 'clear_Kamo_' . $newId . '.' . $extension;
            $imagePath = 'teams/' . $filename;

            $this->image->storePubliclyAs('teams', $filename, 'public');
        }
        //dd("here");
        // Create blog post
        $blog = new Team;          
        $blog->name       = $this->name;
        $blog->salute      = $this->salute;
        $blog->description = $this->description;
        $blog->youtube     = $this->youtube;
        $blog->instagram   = $this->instagram;
        $blog->facebook    = $this->facebook;
        $blog->twitter    = $this->twitter;
        $blog->linkedin   = $this->linkedin;
        $blog->email    = $this->email;
        $blog->position    = $this->position;
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
        $blog = Team::findOrFail($blogId);
        
        $this->blogId = $blog->id;
        $this->name = $blog->name;
        $this->salute = $blog->salute;
        $this->description = $blog->description;
        $this->status = $blog->status;
        $this->currentImage = $blog->image;
        $this->youtube = $blog->youtube    ;
        $this->instagram = $blog->instagram;
        $this->facebook = $blog->facebook;
        $this->twitter = $blog->twitter ;
        $this->position = $blog->position ;
        $this->linkedin = $blog->linkedin;
        $this->email = $blog->email;
        $this->dispatch('set-ckeditor-content', content: $blog->description);
        $this->dispatch('open-modal', 'editBlogModal');
    }

    public function update()
    {
        $this->validate();

        $blog = Team::findOrFail($this->blogId);
        $imagePath = $blog->image;

        // Handle image upload if new image is provided
        if ($this->image) {
            // Delete old image if exists
            if ($blog->image && Storage::disk('public')->exists($blog->image)) {
                Storage::disk('public')->delete($blog->image);
            }

            $extension = $this->image->getClientOriginalExtension();
            $filename  = 'clear_Kamo_' . $blog->id . '.' . $extension;
            $imagePath = 'teams/' . $filename;

            $this->image->storePubliclyAs('teams', $filename, 'public');
        }

        // Update blog post
        $blog->name       = $this->name;
        $blog->salute    = $this->salute;
        $blog->description = $this->description;
        $blog->youtube     = $this->youtube;
        $blog->instagram   = $this->instagram;
        $blog->facebook    = $this->facebook;
        $blog->twitter    = $this->twitter;
        $blog->linkedin   = $this->linkedin;
        $blog->email    = $this->email;
        $blog->position    = $this->position;
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
        $blog = Team::findOrFail($blogId);
        
        $this->viewName = $blog->name;
        $this->viewCategory = $blog->category;
        $this->viewDescription = $blog->description;
        $this->viewStatus = $blog->status;
        $this->viewImage = $blog->image;
        $this->viewYoutube = $blog->youtube    ;
        $this->viewInstagram = $blog->instagram;
        $this->viewFacebook = $blog->facebook;
        $this->viewTwitter = $blog->twitter ;
        $this->viewPosition = $blog->position ;
        $this->viewLinkedin = $blog->linkedin;
        $this->dispatch('open-modal', 'viewBlogModal');
    }

    // Handle delete event from blog list
    public function deleteBlog($blogId)
    {
        $blog = Team::findOrFail($blogId);
        
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
        $this->name       = null;
        $this->salute    = null;
        $this->description = '';
        $this->image       = null;
        $this->imagePath   = null;
        $this->blogId      = null;
        $this->status      = 'draft';
        $this->currentImage = null;
        $this->email       = null;
        $this->facebook    = null;
        $this->instagram       = null;
        $this->linkedin    = null;
        $this->youtube       = null;
        $this->twitter    = null;
        $this->position   = null;
    }
        public function render()
    {
        return view('livewire.team.backend-team-modal');
    }


}