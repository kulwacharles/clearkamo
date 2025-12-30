<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\Blog;
class BlogDetails extends Component
{
    public $blog,$others,$teams;
    public function mount($slug){
        
        $this->blog=Blog::whereSlug($slug)->first();
        $this->others=Blog::where('status','published')->where('id','!=',$this->blog->id)->orderBy('id','desc')->latest()
    ->take(5)
    ->get();;
        //dd($id);
    }
    public function render()
    {
        return view('livewire.frontend.blog-details')->layout("components.layouts.frontend");
    }
}
