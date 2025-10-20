<?php

namespace App\Livewire\About;

use Livewire\WithFileUploads;
use Livewire\Component;
use App\Models\About;

class Abouts extends Component
{
    use WithFileUploads;

    public $title, $description, $years_of_experience, $image, $image2,$image3,$logo;
    public $id, $imagePath, $image2Path,$image3Path, $about1, $about2,$about3,$about4,$logoPath;

    protected $rules = [
        'title' => 'required|min:3|max:255',
        'years_of_experience' => 'required|numeric',
        'description' => 'required|min:10',
        'image' => 'nullable|image|max:2048',
        'image2' => 'nullable|image|max:2048',
        'image3' => 'nullable|image|max:2048',
        'logo'   => 'nullable|image|max:2048',
    ];

    protected $messages = [
        'title.required' => 'The Title is required.',
        'title.min' => 'The Title must be at least 3 characters.',
        'description.required' => 'The description is required.',
        'description.min' => 'The description must be at least 10 characters.',
        'years_of_experience.required' => 'Years of Experience is required.',
        'years_of_experience.numeric' => 'Years of Experience must be a number.',
        'image.image' => 'The Image must be a valid image.',
        'image2.image' => 'The Image must be a valid image.',
        'image3.image' => 'The Image must be a valid image.',
        'logo.image'  => "Logo must be a valid format"
    ];

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
            $this->about4 = $about->logo;
            
            // Push initial description into CKEditor
            $this->dispatch('load-ckeditor-data', $this->description);
        }
    }

    public function render()
    {
        return view('livewire.about.abouts');
    }

    public function store()
    {
        $this->validate();

        // Image 1
        if ($this->image) {
            $extension = $this->image->getClientOriginalExtension();
            $filename = 'about.' . $extension;
            $this->imagePath = 'about/' . $filename;
            $this->image->storePubliclyAs('about', $filename, 'public');
        } else {
            $this->imagePath = $this->about1;
        }

        // Image 2
        if ($this->image2) {
            $extension = $this->image2->getClientOriginalExtension();
            $filename = 'about_us.' . $extension;
            $this->image2Path = 'about/' . $filename;
            $this->image2->storePubliclyAs('about', $filename, 'public');
        } else {
            $this->image2Path = $this->about2;
        }
          // Image 3
        if ($this->image3) {
            $extension = $this->image3->getClientOriginalExtension();
            $filename = 'about_us_home.' . $extension;
            $this->image3Path = 'about/' . $filename;
            $this->image3->storePubliclyAs('about', $filename, 'public');
        } else {
            $this->image3Path = $this->about3;
        }
        //logo
        if ($this->logo) {
            $extension = $this->logo->getClientOriginalExtension();
            $filename = 'about_us_logo.' . $extension;
            $this->logoPath = 'about/' . $filename;
            $this->logo->storePubliclyAs('about', $filename, 'public');
           
        } else {
            $this->logoPath = $this->about4;
        }
   //dd($this->logoPath);
        $here=About::updateOrCreate(
            ['id' => $this->id],
            [
                'title' => $this->title,
                'ex_years' => $this->years_of_experience,
                'image' => $this->imagePath,
                'image2' => $this->image2Path,
                'image3' => $this->image3Path,
                'logo' => $this->logoPath,
                'description' => $this->description,
            ]
        );
        //dd($here);
        session()->flash('message', $this->id ? 'About Updated Successfully.' : 'About Created Successfully.');

        // Reload CKEditor with updated description
        $this->dispatch('load-ckeditor-data', $this->description);
    }
}
