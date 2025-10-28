<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\Service;
class ServiceDetails extends Component
{
    public $service,$teams;
    public function mount($id){
        $this->service=Service::find($id);
        //dd($id);
    }
    public function render()
    {
        return view('livewire.frontend.service-details')->layout("components.layouts.frontend");
    }
}
