<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ChatMessage;
use App\Events\ChatMessageBroadcasted;
use Throwable;

class AdminChat extends Component
{
    public $messages = [];
    public $newMessage = '';
    public $selectedSession = null;
    public $sessions = [];
    public $unreadCount = 0;
    public $activeUser = [];

    protected $rules = [
        'newMessage' => 'required|min:1|max:1000'
    ];

    public function mount()
    {
        $this->loadSessions();
        $this->loadUnreadCount();
    }

    public function loadSessions()
    {
        $sessions = ChatMessage::where('sender_type', 'user')
            ->selectRaw('session_id, name, email, MAX(created_at) as latest_message_time, COUNT(*) as message_count')
            ->groupBy('session_id', 'name', 'email')
            ->orderBy('latest_message_time', 'desc')
            ->get();

        $this->sessions = $sessions->map(function ($session) {
            $lastMessage = ChatMessage::where('session_id', $session->session_id)
                    ->orderBy('created_at', 'desc')
                    ->first();
            
            $unreadCount = ChatMessage::where('session_id', $session->session_id)
                    ->where('sender_type', 'user')
                    ->where('is_read', false)
                    ->count();

            return [
                'session_id' => $session->session_id,
                'name' => $session->name ?: 'Guest User',
                'email' => $session->email ?: 'guest@example.com',
                'last_message' => $lastMessage ? $lastMessage->message : 'No messages yet',
                'last_time' => $lastMessage ? $lastMessage->created_at->diffForHumans() : 'Just now',
                'unread_count' => $unreadCount,
                'message_count' => $session->message_count
            ];
        })->toArray();
    }

    public function loadUnreadCount()
    {
        $this->unreadCount = ChatMessage::where('sender_type', 'user')
            ->where('is_read', false)
            ->count();
    }

    public function selectSession($sessionId)
    {
        $this->selectedSession = $sessionId;
        
        // Get active user info
        $session = ChatMessage::where('session_id', $sessionId)
            ->where('sender_type', 'user')
            ->first();
            
        if ($session) {
            $this->activeUser = [
                'name' => $session->name ?: 'Guest User',
                'email' => $session->email ?: 'guest@example.com'
            ];
        }
        
        $this->loadMessages();
        
        // Mark messages as read
        ChatMessage::where('session_id', $sessionId)
            ->where('sender_type', 'user')
            ->where('is_read', false)
            ->update(['is_read' => true]);
        
        $this->loadSessions();
        $this->loadUnreadCount();
    }

    public function loadMessages()
    {
        if ($this->selectedSession) {
            $this->messages = ChatMessage::where('session_id', $this->selectedSession)
                ->orderBy('created_at', 'asc')
                ->get()
                ->toArray();
        }
    }

    public function sendMessage()
    {
        $this->validate(['newMessage' => 'required|min:1|max:1000']);

        if ($this->selectedSession) {
            $sentMessage = $this->newMessage;
            $message = ChatMessage::create([
                'name' => 'Support Team',
                'email' => 'support@example.com',
                'message' => $sentMessage,
                'sender_type' => 'admin',
                'session_id' => $this->selectedSession,
                'is_read' => true
            ]);

            $this->newMessage = '';
            $this->loadMessages();
            $this->loadSessions();
            $this->loadUnreadCount();
            $this->broadcastMessage($message);
            
            // Dispatch event to frontend user
            $this->dispatch('newAdminMessage', [
                'sessionId' => $this->selectedSession,
                'message' => $sentMessage
            ]);
        }
    }

    public function deleteSession($sessionId)
    {
        ChatMessage::where('session_id', $sessionId)->delete();
        
        if ($this->selectedSession === $sessionId) {
            $this->selectedSession = null;
            $this->messages = [];
        }
        
        $this->loadSessions();
        $this->loadUnreadCount();
    }

    public function render()
    {
        return view('livewire.admin-chat');
    }

    // Listen for new messages from frontend
    public function getListeners()
    {
        return [
            'echo-notification' => 'notifyNewMessage',
            'refreshAdminChat' => 'refreshChatData',
            'refreshAdminInbox' => 'refreshChatData',
        ];
    }

    public function notifyNewMessage()
    {
        $this->loadSessions();
        $this->loadUnreadCount();
        if ($this->selectedSession) {
            $this->loadMessages();
        }
    }

    public function refreshChatData()
    {
        $this->loadSessions();
        $this->loadUnreadCount();
        if ($this->selectedSession) {
            $this->loadMessages();
        }
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
