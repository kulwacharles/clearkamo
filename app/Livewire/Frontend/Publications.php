<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\Publication;
use Livewire\WithPagination;
use App\Models\About;
class Publications extends Component
{
    use WithPagination;
    public $title, $description, $years_of_experience, $image, $image2, $keywords, $logo;
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
        $publications = Publication::where('status', 'published')->paginate(12);

        return view('livewire.frontend.publications',['publications'=>$publications])->layout("components.layouts.frontend", ["title"=>"Our Publications","description"=>"Latest publications","keywords"=>"ClearKamo Publications, publications, clearkamo publications","image"=>$this->logo]);
    }
        public function paginationView()
    {
        return 'vendor.pagination.default';
    }
}
