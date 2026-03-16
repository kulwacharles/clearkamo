<?php

namespace App\Livewire\Gallery;

use Livewire\Component;
use App\Models\GalleryPhoto;
use App\Models\Project;
use Livewire\Attributes\On;

class BackendGallery extends Component
{
    public $photos;
    public $projects;
    public $filterProjectId = '';

    public function mount()
    {
        abort_unless(auth()->check(), 401);
        $this->projects = Project::where('status', 'published')->orderBy('project_name')->get();
        $this->loadPhotos();
    }

    public function loadPhotos()
    {
        $query = GalleryPhoto::with('project')->orderBy('project_id')->orderBy('sort_order')->orderBy('id');
        if ($this->filterProjectId !== '') {
            $query->where('project_id', $this->filterProjectId);
        }
        $this->photos = $query->get();
    }

    #[On('gallery-updated')]
    public function refresh()
    {
        $this->loadPhotos();
    }

    public function render()
    {
        return view('livewire.gallery.backend-gallery')->layout('components.layouts.app');
    }
}
