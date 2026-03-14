<?php

namespace App\Livewire\FocusArea;

use Livewire\Component;
use App\Models\FocusArea;

class BackendFocusArea extends Component
{
    public $focusAreas;

    public function mount()
    {
        abort_unless(auth()->check(), 401);
        $this->focusAreas = FocusArea::orderBy('sort_order')->orderBy('id')->get();
    }

    public function render()
    {
        return view('livewire.focus-area.backend-focus-area')->layout('components.layouts.app');
    }
}
