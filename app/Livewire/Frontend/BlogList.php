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
        $blogs=Blog::where('status','published')->paginate(8);
        return view('livewire.frontend.blog-list',['blogs'=>$blogs])->layout("components.layouts.frontend");
    }
    public function paginationView()
    {
        return 'vendor.pagination.default';
    }
}
