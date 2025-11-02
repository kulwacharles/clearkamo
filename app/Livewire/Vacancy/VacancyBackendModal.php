<?php

namespace App\Livewire\Vacancy;

use Livewire\Component;
use App\Models\Vacancy;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
class VacancyBackendModal extends Component
{


    use WithFileUploads;

    public $title, $category, $description, $image, $imagePath, $blogId, $PostDate,$DueDate,$Positions,$Department,$ReportTo,$contract;
    public $status = 'draft';
    public $currentImage;
    
    // View modal properties
    public $viewTitle, $viewContract, $viewDescription, $viewStatus, $viewImage,$viewPostDate,$viewDueDate,$viewPositions,$viewDepartment,$viewReportTo;

    protected $rules = [
        'title'       => 'required|min:3|max:255',
        'PostDate'    => 'required|Date|max:255',
        'DueDate'    => 'required|Date|max:255',
        'contract'    => 'required|min:3|max:255',
        'Department'  => 'required|max:255',
        'description' => 'required|min:10',
        'image'       => 'nullable|image|max:2048',
        'status'      => 'required|in:published,draft,archived',
    ];

    protected $messages = [
        'title.required'       => 'The Title is required.',
        'PostDate.required'    => 'The Post Date is required.',
        'DueDate.required'     => 'The DueDate is required.',
        'Department.required'  => 'The Department is required.',
        'contract.required'    => 'The Contract Type is required.',
        'title.min'            => 'The Title must be at least 3 characters.',
        'category.required'    => 'The Category is required.',
        'description.required' => 'The Description is required.',
        'description.min'      => 'The Description must be at least 10 characters.',
        'image.image'          => 'The Image must be valid.',
        'image.max'            => 'The Image may not be greater than 2MB.',
        'status.required'      => 'The Status is required.',
        'status.in'            => 'The selected Status is invalid.',
    ];

    public function render()
    {
        return view('livewire.vacancy.vacancy-backend-modal');
    }
    public function store()
    {
        $this->validate();

        $imagePath = null;

        // Handle image upload
        if ($this->image) {
            $last = Vacancy::latest()->first();
            $newId = $last ? $last->id + 1 : 1;

            $extension = $this->image->getClientOriginalExtension();
            $filename  = 'clear_Kamo_' . $newId . '.' . $extension;
            $imagePath = 'blogs/' . $filename;

            $this->image->storePubliclyAs('blogs', $filename, 'public');
        }

        // Create blog post
        $blog = new Vacancy;          
        $blog->title       = $this->title;
        $blog->contract    = $this->contract;
        $blog->description = $this->description;
        $blog->image       = $imagePath;
        $blog->status      = $this->status;
        $blog->post_date   = $this->PostDate;
        $blog->due_date    = $this->DueDate;
        $blog->positions   = $this->Positions;
        $blog->report_to   = $this->ReportTo;
        $blog->department  = $this->Department; 
        $result = $blog->save();
        
        if($result){
            session()->flash('message', 'Vacancy saved successfully.'); 
            $this->resetAll();
            $this->dispatch('reset-ckeditor');
            $this->dispatch('close-modal', 'addBlogModal');
            $this->dispatch('blog-updated');
        }
    }

    // Handle edit event from blog list
    public function editBlog($blogId)
    {
        $blog = Vacancy::findOrFail($blogId);
        
        $this->blogId = $blog->id;
        $this->title = $blog->title;
        $this->contract = $blog->contract;
        $this->description = $blog->description;
        $this->status = $blog->status;
        $this->currentImage = $blog->image;
        $this->PostDate  = $blog->post_date ;
        $this->DueDate = $blog->due_date;
        $this->Positions = $blog->positions;
        $this->ReportTo = $blog->report_to;
        $this->Department=$blog->department;
        $this->dispatch('set-ckeditor-content', content: $blog->description);
        $this->dispatch('open-modal', 'editBlogModal');
    }

    public function update()
    {
        $this->validate();

        $blog = Vacancy::findOrFail($this->blogId);
        $imagePath = $blog->image;

        // Handle image upload if new image is provided
        if ($this->image) {
            // Delete old image if exists
            if ($blog->image && Storage::disk('public')->exists($blog->image)) {
                Storage::disk('public')->delete($blog->image);
            }

            $extension = $this->image->getClientOriginalExtension();
            $filename  = 'clear_Kamo_' . $blog->id . '.' . $extension;
            $imagePath = 'vacancies/' . $filename;

            $this->image->storePubliclyAs('vacancies', $filename, 'public');
        }

        // Update blog post
        $blog->title       = $this->title;
        $blog->contract    = $this->contract;
        $blog->description = $this->description;
        $blog->image       = $imagePath;
        $blog->status      = $this->status;
        $blog->post_date   = $this->PostDate;
        $blog->due_date    = $this->DueDate;
        $blog->positions   = $this->Positions;
        $blog->report_to   = $this->ReportTo;
        $blog->department  = $this->Department;
        $result = $blog->save();
        
        if($result){
            session()->flash('message', 'Vacancy Post updated successfully.'); 
            $this->resetAll();
            $this->dispatch('close-modal', 'editBlogModal');
            $this->dispatch('blog-updated');
        }
    }

    // Handle view event from blog list
    public function viewBlog($blogId)
    {
        $blog = Vacancy::findOrFail($blogId);
        
        $this->viewTitle = $blog->title;
        $this->viewContract = $blog->contract;
        $this->viewDescription = $blog->description;
        $this->viewStatus = $blog->status;
        $this->viewDepartment = $blog->department;
        $this->viewReportTo = $blog->report_to;
        $this->viewDueDate = $blog->due_date;
        $this->viewPostDate = $blog->post_date;
        $this->viewPositions = $blog->positions;
        $this->viewImage = $blog->image;
        
        $this->dispatch('open-modal', 'viewBlogModal');
    }

    // Handle delete event from blog list
    public function deleteBlog($blogId)
    {
        $blog = Vacancy::findOrFail($blogId);
        
        // Delete image if exists
        if ($blog->image && Storage::disk('public')->exists($blog->image)) {
            Storage::disk('public')->delete($blog->image);
        }
        
        $blog->delete();
        
        session()->flash('message', 'Vacancy Post deleted successfully.');
        $this->dispatch('blog-updated');
    }

    public function resetAll()
    {
        $this->title       = null;
        $this->contract    = null;
        $this->description = '';
        $this->image       = null;
        $this->imagePath   = null;
        $this->blogId      = null;
        $this->status      = 'draft';
        $this->currentImage = null;
        $this->PostDate = null;
        $this->DueDate = null;
        $this->Department=null;
        $this->Positions = null;
        $this->ReportTo = null;
    }


}