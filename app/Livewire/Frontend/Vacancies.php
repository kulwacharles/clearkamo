<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\Vacancy;
use Livewire\WithPagination;
class Vacancies extends Component
{

    use WithPagination;
    public function render()
    {
        $vacancies=Vacancy::where('status','published')->paginate(8);
        return view('livewire.frontend.vacancies',['vacancies'=>$vacancies])->layout("components.layouts.frontend");
    }
        public function paginationView()
    {
        return 'vendor.pagination.default';
    }
}
