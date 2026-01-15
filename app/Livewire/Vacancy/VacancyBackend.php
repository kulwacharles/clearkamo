<?php

namespace App\Livewire\Vacancy;

use Livewire\Component;
use App\Models\Vacancy;
class VacancyBackend extends Component
{
    public $blogs;
   
    public function render()
    {
        return view('livewire.vacancy.vacancy-backend')->layout("components.layouts.app");
    }

    public function mount(){
        abort_unless(auth()->check(), 401);
        $this->blogs=Vacancy::all();
    }

}
