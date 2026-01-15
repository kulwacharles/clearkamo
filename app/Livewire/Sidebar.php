<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\About;
class Sidebar extends Component
{ 
    public $logo;
    public function mount(){
        $this->logo=About::first()->logo;
    }
    public function render()
    {
        
        return view('livewire.sidebar');
    }
}
