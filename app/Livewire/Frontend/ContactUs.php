<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\Contact;
use App\Models\About;
use Illuminate\Support\Str;
class ContactUs extends Component
{
 public $title, $description, $years_of_experience, $image, $image2,$keywords,$logo;
    public $id, $imagePath, $image2Path, $about1, $about2,$about3;
        public function mount()
    {
        $about = About::first();
        if ($about) {
            $this->id = $about->id;
            $this->title = "Contact Us - " . $about->title;
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
        
        $contacts=Contact::first();
        return view('livewire.frontend.contact-us',['contact'=>$contacts])->layout("components.layouts.frontend", ["title"=>$this->title,"description"=>Str::limit(html_entity_decode(strip_tags($this->description)), 350, '...'),"keywords"=>$this->keywords,"image"=>$this->logo]);
    }
}
