<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\Publication;
use Illuminate\Support\Str;
class PublicationDetails extends Component
{
    public $publication,$teams;
    public function mount($slug){
        $this->publication=Publication::whereSlug($slug)->first();
        //dd($id);
    }
    public function render()
    {
        return view('livewire.frontend.publication-details')->layout("components.layouts.frontend", ["title"=>$this->publication->title,"description"=>Str::limit(html_entity_decode(strip_tags($this->publication->description)), 350, '...'),"keywords"=>$this->publication->keywords,"image"=>$this->publication->image]);
    }
}
