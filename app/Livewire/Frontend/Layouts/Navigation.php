<?php

namespace App\Livewire\Frontend\Layouts;

use Livewire\Component;
use App\Models\About;
use App\Models\Contact;
use App\Models\Blog;
class Navigation extends Component
{
    public $logo,$contact,$blogs;
    public function mount(){
        $this->logo=About::first()->logo;
        $this->contact=Contact::first();
          $this->blogs=Blog::where('status','published')->orderBy('id','desc')->latest()
    ->take(4)->get();
    }
    public function render()
    {
        return view('livewire.frontend.layouts.navigation');
    }
}
