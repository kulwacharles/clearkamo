<?php

namespace App\Livewire\Publication;

use Livewire\Component;
use App\Models\Publication;
class BackendPublications extends Component
{
   public $publications;
    public function render()
    {
        return view('livewire.publication.backend-publications');
    }
     public function mount(){
        $this->publications=Publication::all();
    }
}
