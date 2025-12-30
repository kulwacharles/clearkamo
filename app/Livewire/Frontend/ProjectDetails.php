<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\Project;
class ProjectDetails extends Component
{
     public $project,$teams;
    public function mount($slug){
        $this->project=Project::whereSlug($slug)->first();
        //dd($id);
    }
    public function render()
    {
        return view('livewire.frontend.project-details')->layout("components.layouts.frontend");
    }
}
