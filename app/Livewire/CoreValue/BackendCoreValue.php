<?php

namespace App\Livewire\CoreValue;

use Livewire\Component;
use App\Models\CoreValue;

class BackendCoreValue extends Component
{
    public $coreValues;

    public function mount()
    {
        abort_unless(auth()->check(), 401);
        $this->coreValues = CoreValue::orderBy('sort_order')->orderBy('id')->get();
    }

    public function render()
    {
        return view('livewire.core-value.backend-core-value')->layout('components.layouts.app');
    }
}
