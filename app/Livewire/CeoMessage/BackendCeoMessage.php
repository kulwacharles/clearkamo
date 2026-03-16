<?php

namespace App\Livewire\CeoMessage;

use Livewire\Component;
use App\Models\CeoMessage;
use Livewire\Attributes\On;

class BackendCeoMessage extends Component
{
    public $messages;

    public function mount()
    {
        abort_unless(auth()->check(), 401);
        $this->loadMessages();
    }

    public function loadMessages()
    {
        $this->messages = CeoMessage::with('team')->latest()->get();
    }

    #[On('ceo-message-updated')]
    public function refresh()
    {
        $this->loadMessages();
    }

    public function render()
    {
        return view('livewire.ceo-message.backend-ceo-message')
            ->layout('components.layouts.app');
    }
}
