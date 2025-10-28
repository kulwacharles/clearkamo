<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\Blog;
use Livewire\WithPagination;
class BlogList extends Component
{
    
    use WithPagination;
    public function render()
    {
        $recents=Blog::where('status','published')->orderBy('id','desc')->latest()
    ->take(5)
    ->get();
        $blogs=Blog::where('status','published')->orderBy('id','desc')->paginate(2);
        return view('livewire.frontend.blog-list',['blogs'=>$blogs,'recents'=>$recents])->layout("components.layouts.frontend");
    }
    public function paginationView()
    {
        return 'vendor.pagination.default';
    }
}
