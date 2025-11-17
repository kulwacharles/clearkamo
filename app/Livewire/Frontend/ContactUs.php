<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\Contact;
class ContactUs extends Component
{

    public function render()
    {
        $contacts=Contact::first();
        return view('livewire.frontend.contact-us',['contact'=>$contacts])->layout("components.layouts.frontend");
    }
}
