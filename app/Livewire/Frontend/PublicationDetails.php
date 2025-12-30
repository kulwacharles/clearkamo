<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\Publication;
class PublicationDetails extends Component
{
    public $publication,$teams;
    public function mount($slug){
        $this->publication=Publication::whereSlug($slug)->first();
        //dd($id);
    }
    public function render()
    {
        return view('livewire.frontend.publication-details')->layout("components.layouts.frontend");
    }
}
