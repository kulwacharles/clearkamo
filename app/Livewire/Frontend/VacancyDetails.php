<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\Vacancy;
class VacancyDetails extends Component
{
    public $vacancy,$teams;
    public function mount($slug){
        $this->vacancy=Vacancy::whereSlug($slug);
        //dd($id);
    }
    public function render()
    {
        return view('livewire.frontend.vacancy-details')->layout("components.layouts.frontend");
    }


}
