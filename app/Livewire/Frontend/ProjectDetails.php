<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\Project;
class ProjectDetails extends Component
{
     public $project,$teams;
    public function mount($id){
        $this->project=Project::find($id);
        //dd($id);
    }
    public function render()
    {
        return view('livewire.frontend.project-details')->layout("components.layouts.frontend");
    }
}
