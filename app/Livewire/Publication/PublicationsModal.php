<?php

namespace App\Livewire\Publication;

use Livewire\Component;
use App\Models\Publication;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Schema;
use Throwable;

class PublicationsModal extends Component
{
    use WithFileUploads;

    public $title, $category, $description, $image, $imagePath, $pubId,$published_date,$keywords;
    public $status = 'draft';
    public $currentImage;
    
    // View modal properties
    public $viewTitle, $viewCategory, $viewDescription, $viewStatus, $viewImage,$viewPublishedDate,$viewKeywords;

    protected $messages = [
        'title.required'       => 'The Title is required.',
        'title.min'            => 'The Title must be at least 3 characters.',
        'category.required'    => 'The Category is required.',
        'description.required' => 'The Description is required.',
        'description.min'      => 'The Description must be at least 10 characters.',
        'image.required'       => 'The Image is required.',
        'image.image'          => 'The Image must be valid.',
        'image.max'            => 'The Image may not be greater than 2MB.',
        'status.required'      => 'The Status is required.',
        'status.in'            => 'The selected Status is invalid.',
        'published_date.required' => 'Publish date required',
    ];

    protected function rules()
    {
        return [
            'title'       => 'required|min:3|max:255',
            'published_date' => 'required|date',
            'category'    => 'required|min:3|max:255',
            'description' => 'required|min:10',
            'image'       => $this->pubId ? 'nullable|image|max:2048' : 'required|image|max:2048',
            'status'      => 'required|in:published,draft,archived',
        ];
    }

    public function store()
    {
        $this->validate();

        try {
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

            $pub = new Publication;
            $this->applyPublicationData($pub, $imagePath);

            if($pub->save()){
                session()->flash('message', 'Publication Post saved successfully.'); 
                $this->resetAll();
                $this->dispatch('reset-ckeditor');
                $this->dispatch('close-modal', 'addBlogModal');
                $this->dispatch('pub-updated');
            }
        } catch (Throwable $e) {
            report($e);
            session()->flash('message', 'Failed to save publication. Please check all required fields and try again.');
        }
    }

    // Handle edit event from blog list
    public function editPub($pubId)
    {
        $pub = Publication::findOrFail($pubId);
        
        $this->pubId = $pub->id;
        $this->title = $pub->title;
        $this->category = $pub->publication_category ?? $pub->category ?? (string) ($pub->category_id ?? '');
        $this->description = $pub->description;
        $this->status = $pub->status;
        $this->currentImage = $pub->image;
        $this->published_date = $pub->published_date;
        $this->keywords = $pub->keywords;
        $this->dispatch('set-ckeditor-content', content: $pub->description);
        $this->dispatch('open-modal', 'editPubModal');
    }

    public function update()
    {
        $this->validate();

        try {
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

            $this->applyPublicationData($pub, $imagePath);

            if($pub->save()){
                session()->flash('message', 'Publication Post updated successfully.'); 
                $this->resetAll();
                $this->dispatch('close-modal', 'editPubModal');
                $this->dispatch('pub-updated');
            }
        } catch (Throwable $e) {
            report($e);
            session()->flash('message', 'Failed to update publication. Please review form values and try again.');
        }
    }

    // Handle view event from blog list
    public function viewPub($pubId)
    {
        $pub = Publication::findOrFail($pubId);
        
        $this->viewTitle = $pub->title;
        $this->viewCategory = $pub->publication_category ?? $pub->category ?? (string) ($pub->category_id ?? 'N/A');
        $this->viewDescription = $pub->description;
        $this->viewStatus = $pub->status;
        $this->viewImage = $pub->image;
        $this->viewPublishedDate = $pub->published_date;
        $this->viewKeywords = $pub->keywords;
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
        $this->published_date = null;
        $this->keywords    = null;
    }

    public function render()
    {
        return view('livewire.publication.publications-modal');
    }

    private function applyPublicationData(Publication $pub, ?string $imagePath): void
    {
        $pub->title = $this->title;
        $pub->description = $this->description;
        $pub->image = $imagePath;

        if (Schema::hasColumn('publications', 'publication_category')) {
            $pub->publication_category = $this->category;
        }

        if (Schema::hasColumn('publications', 'category')) {
            $pub->category = $this->category;
        }

        if (Schema::hasColumn('publications', 'category_id')) {
            $pub->category_id = is_numeric($this->category) ? (int) $this->category : 1;
        }

        if (Schema::hasColumn('publications', 'published_date')) {
            $pub->published_date = $this->published_date;
        }

        if (Schema::hasColumn('publications', 'keywords')) {
            $pub->keywords = $this->keywords;
        }

        if (Schema::hasColumn('publications', 'status')) {
            $pub->status = $this->status;
        }
    }
}
