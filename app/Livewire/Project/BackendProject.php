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
        abort_unless(auth()->check(), 401);
        $this->projects=Project::all();
    }

}
