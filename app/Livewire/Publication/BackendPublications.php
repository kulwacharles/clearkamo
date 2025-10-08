<?php

namespace App\Livewire\Publication;

use Livewire\Component;
use App\Models\Publication;
class BackendPublications extends Component
{
   public $pubs;
    public function render()
    {
        return view('livewire.publication.backend-publications')->layout("components.layouts.app");
    }
     public function mount(){
        $this->pubs=Publication::all();
    }
}
