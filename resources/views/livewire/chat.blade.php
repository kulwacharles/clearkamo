<div>

    <!-- Floating Button -->
    <div wire:click="toggleChat" class="chat-float-btn">
        <svg width="26" height="26" fill="none" stroke="white" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.4-4 8-9 8a9.9 9.9 0 01-4-.8L3 20l1.3-3.5A8 8 0 013 12c0-4.4 4-8 9-8s9 3.6 9 8z"/>
        </svg>
    </div>

    @if($isOpen)
    <div class="chat-container">

        <!-- Header -->
        <div class="chat-header">
            <div>
                <h3>Live Support</h3>
                <span>Typically replies in a few minutes</span>
            </div>
            <button wire:click="toggleChat">✕</button>
        </div>

        <!-- Body -->
        <div class="chat-body">

            @if(!$hasUserInfo)

                <!-- Onboarding Form -->
                <div class="chat-onboard">
                    <h4>Welcome 👋</h4>
                    <p>Please enter your details to begin chatting.</p>

                    <form wire:submit.prevent="saveUserInfo">
                        <input type="text"
                               wire:model="userName"
                               placeholder="Full Name">
                        @error('userName') <span class="error">{{ $message }}</span> @enderror

                        <input type="email"
                               wire:model="userEmail"
                               placeholder="Email Address">
                        @error('userEmail') <span class="error">{{ $message }}</span> @enderror

                        <button type="submit">Start Chat</button>
                    </form>
                </div>

            @else

                <!-- Messages -->
                <div id="chatMessages" class="chat-messages" wire:poll.3s="refreshMessages">
                    @forelse($messages as $message)
                        @if($message['sender_type'] === 'user')
                            <div class="msg-row user">
                                <div class="msg user">
                                    {{ $message['message'] }}
                                </div>
                            </div>
                        @else
                            <div class="msg-row support">
                                <div class="msg support">
                                    {{ $message['message'] }}
                                </div>
                            </div>
                        @endif
                    @empty
                        <div class="empty">
                            Start a conversation with our support team
                        </div>
                    @endforelse
                </div>

                <!-- Input -->
                <form wire:submit.prevent="sendMessage" class="chat-input-area">
                    <input type="text"
                           wire:model="newMessage"
                           placeholder="Type your message...">
                    <button type="submit">Send</button>
                </form>

            @endif

        </div>

    </div>
    @endif


    <style>
        .chat-float-btn {
            position: fixed;
            bottom: 25px;
            right: 25px;
            width: 60px;
            height: 60px;
            background: #2563eb;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 20px 40px rgba(0,0,0,.2);
            z-index: 2147483647;
            transition: all .25s ease;
        }

        .chat-float-btn:hover {
            transform: scale(1.08);
        }

        .chat-container {
            position: fixed;
            bottom: 100px;
            right: 25px;
            width: 380px;
            height: 520px;
            background: #ffffff;
            border-radius: 18px;
            box-shadow: 0 30px 80px rgba(0,0,0,.25);
            display: flex;
            flex-direction: column;
            overflow: hidden;
            z-index: 2147483647;
        }

        .chat-header {
            padding: 18px;
            border-bottom: 1px solid #f0f0f0;
            background: #ffffffcc;
            backdrop-filter: blur(6px);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .chat-header h3 {
            margin: 0;
            font-size: 16px;
        }

        .chat-header span {
            font-size: 12px;
            color: #777;
        }

        .chat-body {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .chat-onboard {
            padding: 30px;
            text-align: center;
        }

        .chat-onboard h4 {
            margin-bottom: 5px;
        }

        .chat-onboard p {
            font-size: 13px;
            color: #777;
            margin-bottom: 20px;
        }

        .chat-onboard input {
            width: 100%;
            padding: 10px;
            margin-bottom: 12px;
            border-radius: 8px;
            border: 1px solid #ddd;
        }

        .chat-onboard button {
            width: 100%;
            padding: 10px;
            border-radius: 8px;
            border: none;
            background: #2563eb;
            color: white;
            cursor: pointer;
        }

        .chat-messages {
            flex: 1;
            padding: 20px;
            overflow-y: auto;
            background: #f9fafb;
        }

        .msg-row {
            margin-bottom: 12px;
            display: flex;
        }

        .msg-row.user {
            justify-content: flex-end;
        }

        .msg-row.support {
            justify-content: flex-start;
        }

        .msg {
            max-width: 75%;
            padding: 10px 14px;
            border-radius: 16px;
            font-size: 14px;
        }

        .msg.user {
            background: #2563eb;
            color: white;
            border-bottom-right-radius: 4px;
        }

        .msg.support {
            background: #e5e7eb;
            color: #111;
            border-bottom-left-radius: 4px;
        }

        .chat-input-area {
            padding: 15px;
            border-top: 1px solid #eee;
            display: flex;
            gap: 10px;
        }

        .chat-input-area input {
            flex: 1;
            padding: 10px;
            border-radius: 20px;
            border: 1px solid #ddd;
        }

        .chat-input-area button {
            padding: 8px 16px;
            border-radius: 20px;
            border: none;
            background: #2563eb;
            color: white;
            cursor: pointer;
        }

        .error {
            font-size: 12px;
            color: red;
        }

        .empty {
            text-align: center;
            color: #888;
            margin-top: 50%;
        }
    </style>

    @if(config('broadcasting.connections.pusher.key'))
        <script src="https://js.pusher.com/8.4.0/pusher.min.js"></script>
        <script>
            document.addEventListener('livewire:initialized', () => {
                const channelName = 'chat.session.{{ $sessionId }}';
                const listenerKey = '__chatRealtimeBound_' + channelName;

                if (window[listenerKey]) {
                    return;
                }

                window[listenerKey] = true;

                if (!window.__ckPusher) {
                    window.__ckPusher = new Pusher('{{ config('broadcasting.connections.pusher.key') }}', {
                        cluster: '{{ config('broadcasting.connections.pusher.options.cluster', 'mt1') }}',
                        forceTLS: '{{ config('broadcasting.connections.pusher.options.useTLS', true) ? 'true' : 'false' }}' === 'true',
                    });
                }

                const channel = window.__ckPusher.subscribe(channelName);
                channel.bind('chat.message.sent', (eventData) => {
                    if (eventData && eventData.session_id === '{{ $sessionId }}') {
                        Livewire.dispatch('refreshUserChat');
                    }
                });
            });
        </script>
    @endif

</div>
