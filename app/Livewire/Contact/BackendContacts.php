<?php

namespace App\Livewire\Contact;

use Livewire\WithFileUploads;
use Livewire\Component;
use App\Models\About;
use App\Models\Contact;

class BackendContacts extends Component
{
          use WithFileUploads;

    public $phone, $map, $physicalAddress, $blogId,$email,$linkedin,$instagram,$twitter,$facebook,$youtube,$extraInfo,$id;
   
    
    // View modal properties
    

    protected $rules = [
        'phone'       => 'required|min:3|max:255',
        'physicalAddress'    => 'required|min:3|max:255',
        'map' => 'required|min:10',
       
        'email'      => 'required|email',
    ];

    protected $messages = [
        'phone.required'       => 'The Physical Address is required.',
        'physicalAddress.min'  => 'The Physical Address must be at least 3 characters.',
        'phone.required'      => 'The Phone is required.',
        'map.required'        =>  'The Map is required.',
        'map.min'                => 'The Map must be at least 10 characters.',
        //'map.url'                =>'please provide valid url for map',
        // 'image.image'          => 'The Image must be valid.',
        // 'image.max'            => 'The Image may not be greater than 2MB.',
        'email.required'      => 'The email is required.',
        'email.email'            => 'The email is invalid.',
    ];
    public function mount()
    {
        abort_unless(auth()->check(), 401);
        $contact = Contact::first();
        if ($contact) {
               $this->map=$contact->map;
               $this->phone=$contact->phone;
               $this->youtube=$contact->youtube;
               $this->instagram=$contact->instagram;
               $this->facebook=$contact->facebook;
               $this->twitter=$contact->twitter;
               $this->linkedin=$contact->linkedin;
               $this->email=$contact->email;
               $this->extraInfo=$contact->extraInfo;
               $this->physicalAddress=$contact->physical_address;
            
      
        }
    }
    public function update()
    {
        $this->validate();
    Contact::updateOrCreate(
            ['id' => $this->id],
            [
                'map'=> $this->map,
                'phone'      => $this->phone,
                'youtube'     => $this->youtube,
                'instagram'   => $this->instagram,
                'facebook'    => $this->facebook,
                'twitter'    => $this->twitter,
                'linkedin'   => $this->linkedin,
                'email'    => $this->email,
                'extraInfo'    => $this->extraInfo,
                'physical_address'=>$this->physicalAddress
            ]
        );
        //dd($here);
        session()->flash('message', $this->id ? 'About Updated Successfully.' : 'About Created Successfully.');


    }
    // public function resetAll()
    // {
    //     $this->phone       = null;
    //     $this->email    = null;
    //     $this->physicalAddress = '';
       
    //     $this->blogId      = null;
   
    //     $this->currentImage = null;
    //     $this->email       = null;
    //     $this->facebook    = null;
    //     $this->instagram       = null;
    //     $this->linkedin    = null;
    //     $this->youtube       = null;
    //     $this->twitter    = null;
    //     $this->map   = null;
    // }
    public function render()
    {
        return view('livewire.contact.backend-contacts');
    }
}
