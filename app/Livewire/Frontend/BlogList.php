<?php

namespace App\Livewire\Frontend;

use Livewire\Component;

class BlogList extends Component
{
    public function render()
    {
        return view('livewire.frontend.blog-list')->layout("components.layouts.frontend");
    }
}
