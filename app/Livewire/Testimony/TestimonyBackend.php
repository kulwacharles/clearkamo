<?php

namespace App\Livewire\Testimony;

use App\Models\Testimony;
use Livewire\Component;

class TestimonyBackend extends Component
{
    public $blogs;
    public function mount(){
        abort_unless(auth()->check(), 401);
        $this->blogs=Testimony::all();
    }
    public function render()
    {
        return view('livewire.testimony.testimony-backend')->layout("components.layouts.app");
    }

}
