<?php

namespace App\Livewire\WhoWeAre;

use App\Models\WhoWeAre as WhoWeAreModel;
use Livewire\Component;
use Livewire\WithFileUploads;

class BackendWhoWeAre extends Component
{
    use WithFileUploads;

    public $recordId;
    public $title = 'Who We Are';
    public $description = '';
    public $years_of_experience = 15;
    public $youtube_url;

    public $image;
    public $secondary_image;
    public $existingImagePath;
    public $existingSecondaryImagePath;

    protected $rules = [
        'title' => 'required|string|min:3|max:255',
        'description' => 'required|string|min:20',
        'years_of_experience' => 'nullable|integer|min:0|max:200',
        'youtube_url' => 'nullable|url|max:255',
        'image' => 'nullable|image|max:20480',
        'secondary_image' => 'nullable|image|max:20480',
    ];

    protected $messages = [
        'title.required' => 'Title is required.',
        'description.required' => 'Description is required.',
        'description.min' => 'Description must be at least 20 characters.',
        'years_of_experience.integer' => 'Years of experience must be a number.',
        'youtube_url.url' => 'Please enter a valid YouTube URL.',
    ];

    public function mount(): void
    {
        abort_unless(auth()->check(), 401);
        $this->loadWhoWeAre();
    }

    public function loadWhoWeAre(): void
    {
        $record = WhoWeAreModel::query()->first();
        if (!$record) {
            return;
        }

        $this->recordId = $record->id;
        $this->title = $record->title;
        $this->description = $record->description;
        $this->years_of_experience = $record->years_of_experience ?? 15;
        $this->youtube_url = $record->youtube_url;
        $this->existingImagePath = $record->image_path;
        $this->existingSecondaryImagePath = $record->secondary_image_path;

        $this->dispatch('load-who-we-are-ckeditor', $this->description);
    }

    public function store(): void
    {
        $this->validate();

        $imagePath = $this->existingImagePath;
        if ($this->image) {
            $imagePath = $this->image->store('who-we-are', 'public');
        }

        $secondaryImagePath = $this->existingSecondaryImagePath;
        if ($this->secondary_image) {
            $secondaryImagePath = $this->secondary_image->store('who-we-are', 'public');
        }

        $record = WhoWeAreModel::query()->updateOrCreate(
            ['id' => $this->recordId],
            [
                'title' => $this->title,
                'description' => $this->description,
                'years_of_experience' => $this->years_of_experience ?: 0,
                'youtube_url' => $this->youtube_url,
                'image_path' => $imagePath,
                'secondary_image_path' => $secondaryImagePath,
            ]
        );

        $this->recordId = $record->id;
        $this->existingImagePath = $record->image_path;
        $this->existingSecondaryImagePath = $record->secondary_image_path;
        $this->image = null;
        $this->secondary_image = null;

        session()->flash('message', 'Who We Are section updated successfully.');
        $this->dispatch('load-who-we-are-ckeditor', $this->description);
    }

    public function render()
    {
        return view('livewire.who-we-are.backend-who-we-are')
            ->layout('components.layouts.app');
    }
}

