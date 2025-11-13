<?php

namespace App\Livewire\Client;

use Livewire\Component;
use App\Models\Client;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
class ClientModal extends Component
{
    use WithFileUploads;

    public $name, $url, $image, $imagePath, $pubId;
    public $status = 'draft';
    public $currentImage;
    
    // View modal properties
    public $viewName, $viewUrl, $viewStatus, $viewImage,$viewPublishedDate;

    protected $rules = [
        'name'       => 'required|min:3|max:255',
        'url' => 'required|min:3|max:255',
        'image'       => 'nullable|image|max:2048',
        'status'      => 'required|in:published,draft,archived',
    ];

    protected $messages = [
        'name.required'       => 'The Name is required.',
        'name.min'            => 'The Name must be at least 3 characters.',
        'url.required'         => 'The URL is required.',
        'url.min'              => 'The URL must be at least 10 characters.',
        'image.image'          => 'The Image must be valid.',
        'image.max'            => 'The Image may not be greater than 2MB.',
        'status.required'      => 'The Status is required.',
        'status.in'            => 'The selected Status is invalid.',

    ];

    public function store()
    {
        $this->validate();

        $imagePath = null;

        // Handle image upload
        if ($this->image) {
            $last = Client::latest()->first();
            $newId = $last ? $last->id + 1 : 1;

            $extension = $this->image->getClientOriginalExtension();
            $filename  = 'clear_Kamo_clients_' . $newId . '.' . $extension;
            $imagePath = 'clients/' . $filename;

            $this->image->storePubliclyAs('clients', $filename, 'public');
        }

        // Create blog post
        $pub = new Client;          
        $pub->name       = $this->name;
        $pub->url    = $this->url;
        $pub->image       = $imagePath;
        $pub->status      = $this->status;

        $result = $pub->save();
        
        if($result){
            session()->flash('message', 'Client details saved successfully.'); 
            $this->resetAll();
            $this->dispatch('reset-ckeditor');
            $this->dispatch('close-modal', 'addBlogModal');
            $this->dispatch('pub-updated');
        }
    }

    // Handle edit event from blog list
    public function editPub($pubId)
    {
        $pub = Client::findOrFail($pubId);
        
        $this->pubId = $pub->id;
        $this->name = $pub->name;
        $this->url = $pub->url;
        $this->status = $pub->status;
        $this->currentImage = $pub->image;
       
        $this->dispatch('open-modal', 'editPubModal');
    }

    public function update()
    {
        $this->validate();

        $pub = Client::findOrFail($this->pubId);
        $imagePath = $pub->image;

        // Handle image upload if new image is provided
        if ($this->image) {
            // Delete old image if exists
            if ($pub->image && Storage::disk('public')->exists($pub->image)) {
                Storage::disk('public')->delete($pub->image);
            }

            $extension = $this->image->getClientOriginalExtension();
            $filename  = 'clear_Kamo_client_' . $pub->id . '.' . $extension;
            $imagePath = 'clients/' . $filename;

            $this->image->storePubliclyAs('clients', $filename, 'public');
        }

        // Update blog post
        $pub->url       = $this->url;
        $pub->name    = $this->name;
      
        //$pub->published_date = $this->published_date;
        $pub->image       = $imagePath;
        $pub->status      = $this->status;

        $result = $pub->save();
        
        if($result){
            session()->flash('message', 'Client details updated successfully.'); 
            $this->resetAll();
            $this->dispatch('close-modal', 'editPubModal');
            $this->dispatch('pub-updated');
        }
    }

    // Handle view event from blog list
    public function viewPub($pubId)
    {
        $pub = Client::findOrFail($pubId);
        
        $this->viewName = $pub->name;
        $this->viewUrl = $pub->url;
        $this->viewStatus = $pub->status;
        $this->viewImage = $pub->image;
        $this->dispatch('open-modal', 'viewPubModal');
    }

    // Handle delete event from blog list
    public function deletePub($pubId)
    {
        $pub = Client::findOrFail($pubId);
        
        // Delete image if exists
        if ($pub->image && Storage::disk('public')->exists($pub->image)) {
            Storage::disk('public')->delete($pub->image);
        }
        
        $pub->delete();
        
        session()->flash('message', 'Publication Post deleted successfully.');
        $this->dispatch('pub-updated');
    }

    public function resetAll()
    {
        $this->name      = null;
        $this->url    = null;
        $this->image       = null;
        $this->imagePath   = null;
        $this->pubId      = null;
        $this->status      = 'draft';
        $this->currentImage = null;
    }
    public function render()
    {
        return view('livewire.client.client-modal');
    }
}
