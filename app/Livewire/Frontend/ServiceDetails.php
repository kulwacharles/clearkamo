<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\Service;
use Illuminate\Support\Str;
class ServiceDetails extends Component
{
    public $service,$teams;
    public function mount($slug){
        $this->service=Service::whereSlug($slug)->first();
        //dd($id);
    }
    public function render()
    {
        return view('livewire.frontend.service-details')->layout("components.layouts.frontend", ["title"=>$this->service->title,"description"=>Str::limit(html_entity_decode(strip_tags($this->service->description)), 350, '...'),"keywords"=>$this->service->keywords,"image"=>$this->service->image]);
    }
}
