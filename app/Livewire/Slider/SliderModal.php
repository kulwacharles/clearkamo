<?php

namespace App\Livewire\Slider;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Slider;
use Illuminate\Support\Facades\Storage;
class SliderModal extends Component
{
    use WithFileUploads;

    public $title, $group, $description, $image, $imagePath, $blogId;
    public $status = 'draft';
    public $currentImage;
    
    // View modal properties
    public $viewTitle, $viewGroup, $viewDescription, $viewStatus, $viewImage;

    protected $rules = [
        'title'       => 'required|min:3|max:255',
        'group'    => 'nullable|min:3|max:255',
        'description' => 'required|min:10',
        'image'       => 'nullable|image|max:2048',
        'status'      => 'required|in:published,draft,archived',
    ];

    protected $messages = [
        'title.required'       => 'The Title is required.',
        'title.min'            => 'The Title must be at least 3 characters.',
        'group.required'    => 'The Category is required.',
        'description.required' => 'The Description is required.',
        'description.min'      => 'The Description must be at least 10 characters.',
        'image.image'          => 'The Image must be valid.',
        'image.max'            => 'The Image may not be greater than 2MB.',
        'status.required'      => 'The Status is required.',
        'status.in'            => 'The selected Status is invalid.',
    ];

    public function store()
    {
        \Log::info('Slider store method started');
        \Log::info('Form data:', [
            'title' => $this->title,
            'group' => $this->group,
            'description' => $this->description,
            'status' => $this->status,
            'image_exists' => $this->image ? 'yes' : 'no'
        ]);

        $this->validate();

        $imagePath = null;

        // Handle image upload
        if ($this->image) {
            \Log::info('Image upload detected');
            $last = Slider::latest()->first();
            $newId = $last ? $last->id + 1 : 1;
            \Log::info('New slider ID will be: ' . $newId);

            $extension = $this->image->getClientOriginalExtension();
            $filename  = 'slider_' . $newId . '.' . $extension;
            $imagePath = 'slider/' . $filename;
            \Log::info('Generated filename: ' . $filename);

            $this->image->storePubliclyAs('slider', $filename, 'public');
            \Log::info('Image stored at: ' . $imagePath);
        } else {
            \Log::info('No image uploaded');
        }

        // Create slider
        $slider = new Slider;          
        $slider->title       = $this->title;
        $slider->group    = $this->group ?? 'default';
        $slider->description = $this->description;
        $slider->image       = $imagePath;
        $slider->status      = $this->status;

        \Log::info('Slider object before save:', [
            'title' => $slider->title,
            'group' => $slider->group,
            'description' => $slider->description,
            'image' => $slider->image,
            'status' => $slider->status
        ]);

        $result = $slider->save();
        
        \Log::info('Slider save result: ' . ($result ? 'SUCCESS' : 'FAILED'));
        if($result) {
            \Log::info('Saved slider ID: ' . $slider->id);
        }
        
        if($result){
            session()->flash('message', 'Slider saved successfully.'); 
            $this->resetAll();
            $this->dispatch('reset-ckeditor');
            $this->dispatch('close-modal', 'addBlogModal');
            $this->dispatch('blog-updated');
            \Log::info('Slider store completed successfully');
        } else {
            \Log::error('Slider store failed');
            session()->flash('error', 'Failed to save slider. Please try again.');
        }
    }

    // Handle edit event from blog list
    public function editBlog($blogId)
    {
        $slider = Slider::findOrFail($blogId);
        
        $this->blogId = $slider->id;
        $this->title = $slider->title;
        $this->group = $slider->group;
        $this->description = $slider->description;
        $this->status = $slider->status;
        $this->currentImage = $slider->image;
        
        $this->dispatch('set-ckeditor-content', content: $slider->description);
        $this->dispatch('open-modal', 'editBlogModal');
    }

    public function update()
    {
        \Log::info('Slider update method started');
        \Log::info('Update data:', [
            'blogId' => $this->blogId,
            'title' => $this->title,
            'group' => $this->group,
            'description' => $this->description,
            'status' => $this->status,
            'image_exists' => $this->image ? 'yes' : 'no'
        ]);

        $this->validate();

        $slider = Slider::findOrFail($this->blogId);
        \Log::info('Found slider to update:', ['id' => $slider->id, 'current_image' => $slider->image]);
        
        $imagePath = $slider->image;

        // Handle image upload if new image is provided
        if ($this->image) {
            \Log::info('New image upload detected for update');
            // Delete old image if exists
            if ($slider->image && Storage::disk('public')->exists($slider->image)) {
                Storage::disk('public')->delete($slider->image);
                \Log::info('Deleted old image: ' . $slider->image);
            }

            $extension = $this->image->getClientOriginalExtension();
            $filename  = 'slider_' . $slider->id . '.' . $extension;
            $imagePath = 'slider/' . $filename;
            \Log::info('Generated new filename: ' . $filename);

            $this->image->storePubliclyAs('slider', $filename, 'public');
            \Log::info('New image stored at: ' . $imagePath);
        } else {
            \Log::info('No new image, keeping existing: ' . $slider->image);
        }

        // Update slider
        $slider->title       = $this->title;
        $slider->group    = $this->group ?? $slider->group;
        $slider->description = $this->description;
        $slider->image       = $imagePath;
        $slider->status      = $this->status;

        \Log::info('Slider object before update:', [
            'id' => $slider->id,
            'title' => $slider->title,
            'group' => $slider->group,
            'description' => $slider->description,
            'image' => $slider->image,
            'status' => $slider->status
        ]);

        $result = $slider->save();
        
        \Log::info('Slider update result: ' . ($result ? 'SUCCESS' : 'FAILED'));
        
        if($result){
            session()->flash('message', 'Slider updated successfully.'); 
            $this->resetAll();
            $this->dispatch('close-modal', 'editBlogModal');
            $this->dispatch('blog-updated');
            \Log::info('Slider update completed successfully');
        } else {
            \Log::error('Slider update failed');
            session()->flash('error', 'Failed to update slider. Please try again.');
        }
    }

    // Handle view event from blog list
    public function viewBlog($blogId)
    {
        $slider = Slider::findOrFail($blogId);
        
        $this->viewTitle = $slider->title;
        $this->viewGroup = $slider->group;
        $this->viewDescription = $slider->description;
        $this->viewStatus = $slider->status;
        $this->viewImage = $slider->image;
        
        $this->dispatch('open-modal', 'viewBlogModal');
    }

    // Handle delete event from blog list
    public function deleteBlog($blogId)
    {
        $slider = Slider::findOrFail($blogId);
        
        // Delete image if exists
        if ($slider->image && Storage::disk('public')->exists($slider->image)) {
            Storage::disk('public')->delete($slider->image);
        }
        
        $slider->delete();
        
        session()->flash('message', 'Slider deleted successfully.');
        $this->dispatch('blog-updated');
    }

    public function resetAll()
    {
        $this->title       = null;
        $this->group    = null;
        $this->description = '';
        $this->image       = null;
        $this->imagePath   = null;
        $this->blogId      = null;
        $this->status      = 'draft';
        $this->currentImage = null;
    }

    public function render()
    {
        return view('livewire.slider.slider-modal');
    }
}
