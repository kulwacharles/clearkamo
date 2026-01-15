<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\Blog;
use Livewire\WithPagination;
use App\Models\About;
class BlogList extends Component
{
    
    use WithPagination;
               public $title, $description, $years_of_experience, $image, $image2,$keywords,$logo;
    public $id, $imagePath, $image2Path, $about1, $about2,$about3;
        public function mount()
    {
        $about = About::first();
        if ($about) {
            $this->id = $about->id;
            $this->title = $about->title;
            $this->description = $about->description;
            $this->years_of_experience = $about->ex_years;
            $this->about1 = $about->image;
            $this->about2 = $about->image2;
            $this->about3 = $about->image3;
            $this->keywords=$about->keywords;
            $this->logo=$about->logo;
            // Push initial description into CKEditor
            //$this->dispatch('load-ckeditor-data', $this->description);
        }
    }
    public function render()
    {
        $recents=Blog::where('status','published')->orderBy('id','desc')->latest()
    ->take(5)
    ->get();
        $blogs=Blog::where('status','published')->orderBy('id','desc')->paginate(2);
        return view('livewire.frontend.blog-list',['blogs'=>$blogs,'recents'=>$recents])->layout("components.layouts.frontend", ["title"=>"News and Updates","description"=>"Latest news and updates","keywords"=>"news,update, news and update, updates from clearkamo","image"=>$this->logo]);
    }
    public function paginationView()
    {
        return 'vendor.pagination.default';
    }
}
