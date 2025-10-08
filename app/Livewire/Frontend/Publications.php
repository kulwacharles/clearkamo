<?php

namespace App\Livewire\Frontend;

use Livewire\Component;

class Publications extends Component
{
    public function render()
    {
        return view('livewire.frontend.publications')->layout("components.layouts.frontend");
    }
}
