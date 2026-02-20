<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ChatMessage;
use App\Events\ChatMessageBroadcasted;
use Throwable;
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
            ->whereNotNull('name')
            ->whereNotNull('email')
            ->first();

        if ($userMessage) {
            $this->userName = $userMessage->name;
            $this->userEmail = $userMessage->email;
            $this->hasUserInfo = true;
        }
    }

    public function saveUserInfo()
    {
        $this->validate([
            'userName' => 'required|min:2|max:50',
            'userEmail' => 'required|email',
        ]);

        $this->hasUserInfo = true;

        $this->dispatch('userInfoSaved');
    }

    public function sendMessage()
    {
        // Prevent sending message if user info not saved
        if (!$this->hasUserInfo) {
            return;
        }

        $this->validate([
            'newMessage' => 'required|min:1|max:1000'
        ]);

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

        $this->broadcastMessage($message);
        $this->dispatch('messageSent');
        $this->dispatch('refreshAdminChat');
    }

    public function toggleChat()
    {
        $this->isOpen = !$this->isOpen;
    }

    public function render()
    {
        return view('livewire.chat');
    }

    public function refreshMessages()
    {
        $this->loadMessages();
    }

    public function getListeners()
    {
        return [
            'refreshUserChat' => 'refreshMessages',
        ];
    }

    private function broadcastMessage(ChatMessage $message): void
    {
        try {
            broadcast(new ChatMessageBroadcasted($message))->toOthers();
        } catch (Throwable $e) {
            report($e);
        }
    }
}
