<?php

namespace App\Livewire\Frontend\Layouts;

use Livewire\Component;
use App\Models\About;
use App\Models\Blog;
use App\Models\Service;
use App\Models\Contact;
class Footer extends Component
{
    public $logo,$blogs,$services,$contact;

    public function mount(){
        $this->blogs=Blog::where('status','published')->orderBy('id','desc')->latest()
    ->take(2)->get();

    $this->services=Service::where('status','published')->orderBy('id','desc')->latest()
    ->take(5)->get();
        $this->logo=About::first()->logo;
        $this->contact=Contact::first();
    }
    public function render()
    {
        return view('livewire.frontend.layouts.footer');
    }
}
