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
        abort_unless(auth()->check(), 401);
        $this->pubs=Publication::all();
    }
}
