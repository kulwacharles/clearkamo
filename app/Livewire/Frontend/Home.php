<?php

namespace App\Livewire\Frontend;
use App\Models\About;
use App\Models\Slider;
use App\Models\Team;
use App\Models\Testimony;
use App\Models\Blog;
use App\Models\Client;
use App\Models\Service;
use Livewire\Component;

class Home extends Component
{
        public $title, $description, $years_of_experience, $image, $image2,$testimonies,$blogs,$services,$clients;
        public $id, $imagePath, $image2Path, $about1, $about2;
        public $slides=null;
        public $teams;

        public function mount()
    {
        $this->services=Service::where("status","published")->get();
        $this->clients=Client::where("status","published")->get();
        $this->slides=Slider::where("status","active")->get();
        $about = About::first();
        $this->testimonies=Testimony::where('status','published')->get();
        $this->blogs=Blog::where('status','published')->orderBy('id','desc')->latest()->take(5)->get();
        $this->teams=Team::where('status',"published")->get();
        if ($about) {
            $this->id = $about->id;
            $this->title = $about->title;
            $this->description = $about->description;
            $this->years_of_experience = $about->ex_years;
            $this->about1 = $about->image;
            $this->about2 = $about->image2;

            // Push initial description into CKEditor
            //$this->dispatch('load-ckeditor-data', $this->description);
        }
        
    }
    public function render()
    {
        return view('livewire.frontend.home')->layout("components.layouts.frontend");
    }
}
