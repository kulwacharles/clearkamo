<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\Team;
use Illuminate\Support\Str;
class TeamDetails extends Component
{
    public $member,$teams;
    public function mount($slug){
        $this->member=Team::whereSlug($slug)->first();
        //dd($id);
    }
    public function render()
    {
        return view('livewire.frontend.team-details')->layout("components.layouts.frontend", ["title"=>$this->member->name,"description"=>Str::limit(html_entity_decode(strip_tags($this->member->position)), 350, '...'),"keywords"=>$this->member->position,"image"=>$this->member->image]);
    }
}
