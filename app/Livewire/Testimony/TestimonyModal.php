<?php

namespace App\Livewire\Testimony;

use Livewire\Component;
use App\Models\Testimony;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Throwable;
class TestimonyModal extends Component
{
    use WithFileUploads;

    public $name, $category, $description, $image, $imagePath, $blogId, $PostDate,$DueDate,$position;
    public $status = 'draft';
    public $currentImage;
    
    // View modal properties
    public $viewName,  $viewDescription, $viewStatus, $viewImage,$viewPosition;

    protected $messages = [
        'name.required'        => 'The testimonial name is required.',
        'name.min'             => 'The testimonial name must be at least 3 characters.',
        'position.required'    => 'The testimonial position is required.',
        'position.min'         => 'The testimonial position must be at least 2 characters.',
        'description.required' => 'The testimonial description is required.',
        'description.min'      => 'The testimonial description must be at least 10 characters.',
        'image.required'       => 'The testimonial image is required.',
        'image.image'          => 'The testimonial image must be valid.',
        'image.max'            => 'The testimonial image may not be greater than 20MB.',
        'status.required'      => 'The testimonial status is required.',
        'status.in'            => 'The selected testimonial status is invalid.',
    ];

    protected function rules(): array
    {
        return [
            'name'        => 'required|min:3|max:255',
            'position'    => 'required|min:2|max:255',
            'description' => 'required|min:10',
            'image'       => $this->blogId ? 'nullable|image|max:20480' : 'required|image|max:20480',
            'status'      => 'required|in:published,draft,archived',
        ];
    }

    public function store()
    {
        $this->validate();
        try {
            $imagePath = null;

            if ($this->image) {
                $last = Testimony::latest()->first();
                $newId = $last ? $last->id + 1 : 1;

                $extension = $this->resolveImageExtension($this->image);
                $filename  = 'testimony_' . $newId . '_' . now()->timestamp . '_' . Str::lower(Str::random(6)) . '.' . $extension;
                $imagePath = 'testimony/' . $filename;

                $this->image->storePubliclyAs('testimony', $filename, 'public');
            }

            $blog = new Testimony;
            $blog->name = $this->name;
            $blog->description = $this->description;
            $blog->image = $imagePath;
            $blog->status = $this->status;
            $blog->position = $this->position;

            if ($blog->save()) {
                session()->flash('message', 'Testimonial saved successfully.');
                $this->resetAll();
                $this->dispatch('reset-ckeditor');
                $this->dispatch('close-modal', 'addBlogModal');
                $this->dispatch('blog-updated');
            }
        } catch (Throwable $e) {
            report($e);
            session()->flash('error', 'Failed to save testimonial. Please confirm all required fields are filled and the image upload completed.');
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
        try {
            $blog = Testimony::findOrFail($this->blogId);
            $imagePath = $blog->image;

            if ($this->image) {
                if ($blog->image && Storage::disk('public')->exists($blog->image)) {
                    Storage::disk('public')->delete($blog->image);
                }

                $extension = $this->resolveImageExtension($this->image);
                $filename  = 'testimony_' . $blog->id . '_' . now()->timestamp . '_' . Str::lower(Str::random(6)) . '.' . $extension;
                $imagePath = 'testimony/' . $filename;

                $this->image->storePubliclyAs('testimony', $filename, 'public');
            }

            $blog->name = $this->name;
            $blog->description = $this->description;
            $blog->image = $imagePath;
            $blog->status = $this->status;
            $blog->position = $this->position;

            if ($blog->save()) {
                session()->flash('message', 'Testimonial updated successfully.');
                $this->resetAll();
                $this->dispatch('close-modal', 'editBlogModal');
                $this->dispatch('blog-updated');
            }
        } catch (Throwable $e) {
            report($e);
            session()->flash('error', 'Failed to update testimonial. Please try again after the image upload finishes.');
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

    public function temporaryImagePreviewUrl($file): ?string
    {
        if (!$file) {
            return null;
        }

        try {
            return $file->temporaryUrl();
        } catch (Throwable) {
            return null;
        }
    }

    private function resolveImageExtension($file): string
    {
        $extension = strtolower((string) $file->getClientOriginalExtension());
        if ($extension !== '') {
            return $extension;
        }

        $guessed = strtolower((string) $file->guessExtension());
        return $guessed !== '' ? $guessed : 'jpg';
    }


    public function render()
    {
        return view('livewire.testimony.testimony-modal');
    }
}
