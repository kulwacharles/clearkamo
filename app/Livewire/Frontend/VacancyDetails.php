<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\Vacancy;
use Illuminate\Support\Str;
class VacancyDetails extends Component
{
    public $vacancy,$teams;
    public function mount($slug){
         $this->vacancy=Vacancy::whereSlug($slug)->first();
        //dd($id);
    }
    public function render()
    {
        return view('livewire.frontend.vacancy-details')->layout("components.layouts.frontend", ["title"=>$this->vacancy->title,"description"=>Str::limit(html_entity_decode(strip_tags($this->vacancy->description)), 350, '...'),"keywords"=>$this->vacancy->keywords,"image"=>$this->vacancy->image]);
    }


}
