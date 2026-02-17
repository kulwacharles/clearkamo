<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\WhoWeAre;

class WhoWeAreComponent extends Component
{
    public $content;

    public function mount()
    {
        $this->content = WhoWeAre::first();
    }

    public function render()
    {
        return view('livewire.frontend.who-we-are', [
            'whoWeAre' => $this->content,
        ]);
    }
}