<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\Project;
use Livewire\WithPagination;
use App\Models\About;
use Illuminate\Support\Str;
class Projects extends Component
{
    use WithPagination;
       public $title, $description, $years_of_experience, $image, $image2,$keywords,$logo;
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
            $this->keywords=$about->keywords;
            $this->logo=$about->logo;
            // Push initial description into CKEditor
            //$this->dispatch('load-ckeditor-data', $this->description);
        }
    }
    public function render()
    {
        $projects=Project::where('status','published')->paginate(8);
        return view('livewire.frontend.projects',['projects'=>$projects])->layout("components.layouts.frontend", ["title"=>"Projects","description"=>"Our projects","keywords"=>"projects, portfolio, clearkamo projects","image"=>$this->logo]);
    }
}
