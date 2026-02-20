<?php

namespace App\Events;

use App\Models\ChatMessage;
use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ChatMessageBroadcasted implements ShouldBroadcastNow
{
    use Dispatchable, SerializesModels;

    public array $payload;

    public function __construct(ChatMessage $message)
    {
        $this->payload = [
            'id' => $message->id,
            'session_id' => $message->session_id,
            'sender_type' => $message->sender_type,
            'name' => $message->name,
            'email' => $message->email,
            'message' => $message->message,
            'created_at' => optional($message->created_at)->toISOString(),
        ];
    }

    public function broadcastOn(): array
    {
        return [
            new Channel('chat.admin.inbox'),
            new Channel('chat.session.' . $this->payload['session_id']),
        ];
    }

    public function broadcastAs(): string
    {
        return 'chat.message.sent';
    }

    public function broadcastWith(): array
    {
        return $this->payload;
    }
}
