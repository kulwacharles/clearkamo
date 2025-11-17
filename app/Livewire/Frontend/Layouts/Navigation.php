<?php

namespace App\Livewire\Frontend\Layouts;

use Livewire\Component;
use App\Models\About;
use App\Models\Contact;
class Navigation extends Component
{
    public $logo,$contact;
    public function mount(){
        $this->logo=About::first()->logo;
        $this->contact=Contact::first();
    }
    public function render()
    {
        return view('livewire.frontend.layouts.navigation');
    }
}
