<?php

namespace App\Livewire\Slider;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Slider;

class SliderModal extends Component
{
    use WithFileUploads;

    public $title, $group, $description, $image, $imagePath, $sliderId;

    protected $rules = [
        'title'       => 'required|min:3|max:255',
        'group'       => 'required|min:3|max:255',
        'description' => 'required|min:10',
        'image'       => 'nullable|image|max:2048', // nullable for edit
    ];

    protected $messages = [
        'title.required'       => 'The Title is required.',
        'title.min'            => 'The Title must be at least 3 characters.',
        'group.required'       => 'The Group is required.',
        'group.min'            => 'The Group must be at least 3 characters.',
        'description.required' => 'The Description is required.',
        'description.min'      => 'The Description must be at least 10 characters.',
        'image.image'          => 'The Image must be valid.',
        'image.max'            => 'The Image may not be greater than 2MB.',
    ];

    public function store()
    {
        $this->validate();

        $imagePath = $this->imagePath;

        // Handle image upload
        if ($this->image) {
            $last = Slider::latest()->first();
            $newId = $last ? $last->id + 1 : 1;

            $extension = $this->image->getClientOriginalExtension();
            $filename  = 'slider_' . $newId . '.' . $extension;
            $imagePath = 'slider/' . $filename;

            $this->image->storePubliclyAs('slider', $filename, 'public');
        }

        // Create or update slider
        $slide=new Slider;          
        $slide['title']       = $this->title;
        $slide['group']       = $this->group;
        $slide['description'] = $this->description;
        $slide['image']       = $imagePath;

        $result=$slide->save();
        if($result){
            session()->flash('message', 'Slider saved successfully.'); 
             // Reset all fields
            $this->resetFields();

            // Trigger CKEditor reset and close modal
            $this->dispatch('reset-ckeditor');
            $this->dispatch('close-modal');
           
            // Notify parent component to refresh list if needed
            //$this->emit('sliderSaved');
        }
       

       
    }

    private function resetFields()
    {
        $this->title       = null;
        $this->group       = null;
        $this->description = '';
        $this->image       = null;
        $this->imagePath   = null;
        $this->sliderId    = null;
    }

    public function render()
    {
        return view('livewire.slider.slider-modal');
    }
}
