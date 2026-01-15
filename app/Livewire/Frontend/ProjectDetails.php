<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\Project;
use Illuminate\Support\Str;
class ProjectDetails extends Component
{
     public $project,$teams;
    public function mount($slug){
        $this->project=Project::whereSlug($slug)->first();
        //dd($id);
    }
    public function render()
    {
        return view('livewire.frontend.project-details')->layout("components.layouts.frontend", ["title"=>$this->project->title,"description"=>Str::limit(html_entity_decode(strip_tags($this->project->description)), 350, '...'),"keywords"=>$this->project->keywords,"image"=>$this->project->image]);
    }
}
