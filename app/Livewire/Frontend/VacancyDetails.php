<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\Vacancy;
class VacancyDetails extends Component
{
    public $vacancy,$teams;
    public function mount($id){
        $this->vacancy=Vacancy::find($id);
        //dd($id);
    }
    public function render()
    {
        return view('livewire.frontend.vacancy-details')->layout("components.layouts.frontend");
    }


}
