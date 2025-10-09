<?php

namespace App\Livewire\Project;

use Livewire\Component;
use App\Models\Project;

class BackendProject extends Component
{
    public $projects;
    public function render()
    {
        return view('livewire.project.backend-project')->layout("components.layouts.app");
    }
    public function mount(){
        $this->projects=Project::all();
    }

}
