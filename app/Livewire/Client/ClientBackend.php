<?php

namespace App\Livewire\Client;

use Livewire\Component;
use App\Models\Client;
class ClientBackend extends Component
{
    public $pubs;
    public function render()
    {
        return view('livewire.client.client-backend')->layout("components.layouts.app");
    }
    public function mount(){
        abort_unless(auth()->check(), 401);
        $this->pubs=Client::all();
    }
}
