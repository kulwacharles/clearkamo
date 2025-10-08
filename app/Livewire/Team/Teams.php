<?php

namespace App\Livewire\Team;

use Livewire\Component;
use App\Models\Team;
class Teams extends Component
{
    public $members;
    public function render()
    {
        return view('livewire.team.teams');
    }
    public function mount(){
        $this->members=Team::all();
    }
}
