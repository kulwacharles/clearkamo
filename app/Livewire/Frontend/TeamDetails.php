<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\Team;
class TeamDetails extends Component
{
    public $member,$teams;
    public function mount($slug){
        $this->member=Team::whereSlug($slug)->first();
        //dd($id);
    }
    public function render()
    {
        return view('livewire.frontend.team-details')->layout("components.layouts.frontend");
    }
}
