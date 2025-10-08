<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\About;
class AboutUs extends Component
{
    public $title, $description, $years_of_experience, $image, $image2;
    public $id, $imagePath, $image2Path, $about1, $about2,$about3;
        public function mount()
    {
        $about = About::first();
        if ($about) {
            $this->id = $about->id;
            $this->title = $about->title;
            $this->description = $about->description;
            $this->years_of_experience = $about->ex_years;
            $this->about1 = $about->image;
            $this->about2 = $about->image2;
            $this->about3 = $about->image3;
            // Push initial description into CKEditor
            //$this->dispatch('load-ckeditor-data', $this->description);
        }
    }
    public function render()
    {
        return view('livewire.frontend.about-us')->layout("components.layouts.frontend");
    }
}
