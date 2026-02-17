<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ChatMessage;
use Illuminate\Support\Facades\Session;

class Chat extends Component
{
    public $messages = [];
    public $newMessage = '';
    public $userName = '';
    public $userEmail = '';
    public $isOpen = false;
    public $sessionId;
    public $hasUserInfo = false;

    protected $rules = [
        'userName' => 'required|min:2|max:50',
        'userEmail' => 'required|email',
        'newMessage' => 'required|min:1|max:1000'
    ];

    public function mount()
    {
        $this->sessionId = Session::getId();
        $this->loadMessages();
        $this->checkUserInfo();
    }

    public function loadMessages()
    {
        $this->messages = ChatMessage::where('session_id', $this->sessionId)
            ->orderBy('created_at', 'asc')
            ->get()
            ->toArray();
    }

    public function checkUserInfo()
    {
        $userMessage = ChatMessage::where('session_id', $this->sessionId)
            ->where('sender_type', 'user')
            ->first();

        if ($userMessage && $userMessage->name && $userMessage->email) {
            $this->userName = $userMessage->name;
            $this->userEmail = $userMessage->email;
            $this->hasUserInfo = true;
        }
    }

    public function saveUserInfo()
    {
        $this->validate([
            'userName' => 'required|min:2|max:50',
            'userEmail' => 'required|email'
        ]);

        $this->hasUserInfo = true;
        $this->dispatch('userInfoSaved');
    }

    public function sendMessage()
    {
        if (!$this->hasUserInfo) {
            $this->saveUserInfo();
        }

        $this->validate(['newMessage' => 'required|min:1|max:1000']);

        $message = ChatMessage::create([
            'name' => $this->userName,
            'email' => $this->userEmail,
            'message' => $this->newMessage,
            'sender_type' => 'user',
            'session_id' => $this->sessionId,
            'is_read' => false
        ]);

        $this->newMessage = '';
        $this->loadMessages();
        
        $this->dispatch('messageSent');
        $this->dispatch('refreshAdminChat'); // Notify admin of new message
        $this->dispatch('echo-notification'); // Real-time notification
    }

    public function toggleChat()
    {
        $this->isOpen = !$this->isOpen;
    }

    public function render()
    {
        return view('livewire.chat');
    }
}
