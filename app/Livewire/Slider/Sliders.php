<?php

namespace App\Livewire\Slider;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Slider;
class Sliders extends Component
{
     public $slides;

     public function render()
    {
        
        return view('livewire.slider.sliders')->layout("components.layouts.app");
    }
    public function mount(){
        $this->slides=Slider::all();
    }

}
