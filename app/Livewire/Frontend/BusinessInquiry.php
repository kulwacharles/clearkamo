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
    public string $job_title = '';
    public string $industry = '';
    public string $company_size = '';
    public string $website = '';
    public string $country = '';
    public string $city = '';
    public string $service_interest = '';
    public string $budget_range = '';
    public string $timeline = '';
    public string $business_summary = '';
    public string $challenge_details = '';
    public string $goals = '';
    public string $additional_details = '';
    public bool $submitted = false;

    protected function rules(): array
    {
        return [
            'full_name' => ['required', 'string', 'min:3', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:60'],
            'company_name' => ['required', 'string', 'min:2', 'max:255'],
            'job_title' => ['nullable', 'string', 'max:255'],
            'industry' => ['nullable', 'string', 'max:255'],
            'company_size' => ['nullable', 'string', 'max:120'],
            'website' => ['nullable', 'url', 'max:255'],
            'country' => ['nullable', 'string', 'max:120'],
            'city' => ['nullable', 'string', 'max:120'],
            'service_interest' => ['nullable', 'string', 'max:255'],
            'budget_range' => ['nullable', 'string', 'max:255'],
            'timeline' => ['nullable', 'string', 'max:255'],
            'business_summary' => ['required', 'string', 'min:20'],
            'challenge_details' => ['nullable', 'string'],
            'goals' => ['nullable', 'string'],
            'additional_details' => ['nullable', 'string'],
        ];
    }

    public function submit(): void
    {
        $validated = $this->validate();
        $validated['status'] = 'new';

        BusinessInquiryModel::create($validated);

        $this->reset([
            'full_name', 'email', 'phone', 'company_name', 'job_title', 'industry', 'company_size',
            'website', 'country', 'city', 'service_interest', 'budget_range', 'timeline',
            'business_summary', 'challenge_details', 'goals', 'additional_details',
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
