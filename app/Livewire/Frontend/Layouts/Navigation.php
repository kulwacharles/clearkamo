<?php

namespace App\Livewire\Frontend\Layouts;

use Livewire\Component;
use App\Models\About;
class Navigation extends Component
{
    public $logo;
    public function mount(){
        $this->logo=About::first()->logo;
    }
    public function render()
    {
        return view('livewire.frontend.layouts.navigation');
    }
}
