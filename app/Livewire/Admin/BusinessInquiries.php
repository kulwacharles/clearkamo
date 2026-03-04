<?php

namespace App\Livewire\Admin;

use App\Models\BusinessInquiry;
use Livewire\Component;

class BusinessInquiries extends Component
{
    public ?int $selectedId = null;
    public ?BusinessInquiry $selectedInquiry = null;

    public function viewInquiry(int $id): void
    {
        $this->selectedId = $id;
        $this->selectedInquiry = BusinessInquiry::find($id);
    }

    public function markReviewed(int $id): void
    {
        $inquiry = BusinessInquiry::find($id);
        if (!$inquiry) {
            return;
        }

        $inquiry->status = 'reviewed';
        $inquiry->save();
    }

    public function render()
    {
        return view('livewire.admin.business-inquiries', [
            'inquiries' => BusinessInquiry::query()->latest()->get(),
        ])->layout('components.layouts.app');
    }
}
