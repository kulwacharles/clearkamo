<?php

namespace App\Livewire\Team;

use Livewire\Component;
use App\Models\Team;
class BackendTeam extends Component
{
     public $blogs;
    public function render()
    {
        return view('livewire.team.backend-team')->layout("components.layouts.app");
    }

    public function mount(){
        abort_unless(auth()->check(), 401);
        $this->blogs=Team::all();
    }
}
