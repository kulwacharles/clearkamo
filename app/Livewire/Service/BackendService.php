<?php

namespace App\Livewire\Service;

use Livewire\Component;
use App\Models\Service;

class BackendService extends Component
{
    public $services;
    public function render()
    {
        return view('livewire.service.backend-service')->layout("components.layouts.app");
    }
    public function mount(){
        abort_unless(auth()->check(), 401);
        $this->services=Service::all();
    }

}
