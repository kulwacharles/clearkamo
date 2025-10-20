<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\Team;
class TeamDetails extends Component
{
    public $member,$teams;
    public function mount($id){
        $this->member=Team::find($id);
        //dd($id);
    }
    public function render()
    {
        return view('livewire.frontend.team-details')->layout("components.layouts.frontend");
    }
}
