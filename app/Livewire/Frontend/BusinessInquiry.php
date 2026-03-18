<?php

namespace App\Livewire\Frontend;

use App\Models\About;
use App\Models\BusinessInquiry as BusinessInquiryModel;
use Livewire\Component;

class BusinessInquiry extends Component
{
    public string $full_name = '';
    public string $email = '';
    public string $phone = '';
    public string $company_name = '';
    public string $business_summary = '';
    public bool $submitted = false;

    protected function rules(): array
    {
        return [
            'full_name' => ['required', 'string', 'min:3', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:60'],
            'company_name' => ['required', 'string', 'min:2', 'max:255'],
            'business_summary' => ['required', 'string', 'min:20'],
        ];
    }

    public function submit(): void
    {
        $validated = $this->validate();
        $validated['status'] = 'new';

        BusinessInquiryModel::create($validated);

        $this->reset([
            'full_name', 'email', 'phone', 'company_name', 'business_summary',
        ]);

        $this->submitted = true;
    }

    public function render()
    {
        $about = About::first();

        return view('livewire.frontend.business-inquiry')->layout('components.layouts.frontend', [
            'title' => 'Tell Us About Your Business',
            'description' => 'Share your business needs and challenges. Our team will review and contact you with a practical solution path.',
            'keywords' => 'business inquiry, consulting form, project clear contact',
            'image' => $about?->logo,
        ]);
    }
}
