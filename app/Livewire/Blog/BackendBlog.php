<?php

namespace App\Livewire\Blog;

use Livewire\Component;
use App\Models\Blog;

class BackendBlog extends Component
{
    public $blogs;
    public function render()
    {
        return view('livewire.blog.backend-blog')->layout("components.layouts.app");
    }
    public function mount(){
        $this->blogs=Blog::all();
    }

}
