<?php

namespace App\Livewire\Frontend;

use Livewire\Component;

class Seo extends Component
{
    public $title;
    public $description;
    public $image;

    public function mount($title = '', $description = '', $image = '')
    {
        $this->title = $title;
        $this->description = $description;
        $this->image = $image;
    }

    public function render()
    {
        return view('livewire.frontend.seo');
    }
}

