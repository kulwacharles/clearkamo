<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\Project;
use Livewire\WithPagination;
class Projects extends Component
{
    use WithPagination;
    public function render()
    {
        $projects=Project::where('status','published')->paginate(8);
        return view('livewire.frontend.projects',['projects'=>$projects])->layout("components.layouts.frontend");
    }
}
