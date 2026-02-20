<div class="col-12">
    <style>
        .admin-chat-ui {
            --ac-border: #e8edf3;
            --ac-text: #2f3a4a;
            --ac-muted: #7a8799;
            --ac-bg: #f4f7fb;
            --ac-white: #ffffff;
            --ac-primary: #3b82f6;
            --ac-primary-dark: #2563eb;
            --ac-success: #10b981;
            --ac-danger: #ef4444;
        }

        html[data-admin-theme='dark'] .admin-chat-ui {
            --ac-border: #243247;
            --ac-text: #eaf0ff;
            --ac-muted: #a4b3c8;
            --ac-bg: #0b1220;
            --ac-white: #0f1522;
            --ac-primary: #3b82f6;
            --ac-primary-dark: #2563eb;
            --ac-success: #22c55e;
            --ac-danger: #ef4444;
        }

        .admin-chat-ui {
            background: var(--ac-bg);
            border: 1px solid var(--ac-border);
            border-radius: 16px;
            padding: 18px;
            color: var(--ac-text);
        }

        .admin-chat-ui * {
            box-sizing: border-box;
        }

        .admin-chat-ui .ac-header {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            gap: 10px;
            background: var(--ac-white);
            border: 1px solid var(--ac-border);
            border-radius: 12px;
            padding: 14px 16px;
            margin-bottom: 16px;
        }

        .admin-chat-ui .ac-title {
            margin: 0;
            font-size: 24px;
            font-weight: 700;
            color: var(--ac-text);
        }

        .admin-chat-ui .ac-subtitle {
            margin: 4px 0 0;
            font-size: 13px;
            color: var(--ac-muted);
        }

        .admin-chat-ui .ac-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            align-self: center;
            background: rgba(59, 130, 246, .16);
            color: #8cb8ff;
            border-radius: 999px;
            padding: 7px 12px;
            font-size: 13px;
            font-weight: 600;
        }

        .admin-chat-ui .ac-badge-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--ac-primary);
        }

        .admin-chat-ui .ac-layout {
            display: grid;
            grid-template-columns: 340px 1fr;
            gap: 16px;
            min-height: 620px;
        }

        .admin-chat-ui .ac-panel {
            background: var(--ac-white);
            border: 1px solid var(--ac-border);
            border-radius: 12px;
            overflow: hidden;
        }

        .admin-chat-ui .ac-panel-head {
            border-bottom: 1px solid var(--ac-border);
            padding: 14px 16px;
        }

        .admin-chat-ui .ac-panel-title {
            margin: 0;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: .4px;
            font-weight: 700;
            color: var(--ac-text);
        }

        .admin-chat-ui .ac-panel-meta {
            margin: 4px 0 0;
            font-size: 12px;
            color: var(--ac-muted);
        }

        .admin-chat-ui .ac-session-list {
            max-height: 540px;
            overflow-y: auto;
        }

        .admin-chat-ui .ac-session-item {
            width: 100%;
            border: 0;
            border-bottom: 1px solid var(--ac-border);
            background: transparent;
            text-align: left;
            padding: 12px 14px;
            cursor: pointer;
            transition: background .15s ease;
        }

        .admin-chat-ui .ac-session-item:hover {
            background: rgba(59, 130, 246, .08);
        }

        .admin-chat-ui .ac-session-item.is-active {
            background: rgba(59, 130, 246, .14);
        }

        .admin-chat-ui .ac-session-row {
            display: flex;
            gap: 10px;
            align-items: flex-start;
        }

        .admin-chat-ui .ac-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 13px;
            color: #9dc2ff;
            background: rgba(59, 130, 246, .16);
            flex-shrink: 0;
        }

        .admin-chat-ui .ac-session-content {
            min-width: 0;
            flex: 1;
        }

        .admin-chat-ui .ac-session-top {
            display: flex;
            justify-content: space-between;
            gap: 8px;
        }

        .admin-chat-ui .ac-name,
        .admin-chat-ui .ac-email,
        .admin-chat-ui .ac-preview,
        .admin-chat-ui .ac-time {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            margin: 0;
        }

        .admin-chat-ui .ac-name {
            font-size: 14px;
            font-weight: 600;
            color: var(--ac-text);
            max-width: 170px;
        }

        .admin-chat-ui .ac-time {
            font-size: 11px;
            color: var(--ac-muted);
            flex-shrink: 0;
        }

        .admin-chat-ui .ac-email {
            margin-top: 2px;
            font-size: 12px;
            color: var(--ac-muted);
        }

        .admin-chat-ui .ac-preview {
            margin-top: 3px;
            font-size: 13px;
            color: var(--ac-muted);
        }

        .admin-chat-ui .ac-unread {
            margin-left: 6px;
            min-width: 20px;
            height: 20px;
            border-radius: 999px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: var(--ac-danger);
            color: #fff;
            font-size: 11px;
            font-weight: 700;
            padding: 0 6px;
        }

        .admin-chat-ui .ac-chat-head {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 8px;
            padding: 14px 16px;
            border-bottom: 1px solid var(--ac-border);
            background: var(--ac-white);
        }

        .admin-chat-ui .ac-chat-user {
            display: flex;
            align-items: center;
            gap: 10px;
            min-width: 0;
        }

        .admin-chat-ui .ac-status {
            font-size: 11px;
            font-weight: 600;
            color: #047857;
            background: #dcfce7;
            border-radius: 999px;
            padding: 5px 9px;
            white-space: nowrap;
        }

        .admin-chat-ui .ac-messages {
            height: 460px;
            overflow-y: auto;
            background: var(--ac-bg);
            padding: 14px;
        }

        .admin-chat-ui .ac-message-row {
            display: flex;
            margin-bottom: 10px;
        }

        .admin-chat-ui .ac-message-row.user {
            justify-content: flex-start;
        }

        .admin-chat-ui .ac-message-row.admin {
            justify-content: flex-end;
        }

        .admin-chat-ui .ac-bubble {
            max-width: min(640px, 82%);
            border-radius: 12px;
            padding: 10px 12px;
            font-size: 14px;
            line-height: 1.45;
            box-shadow: 0 1px 2px rgba(0, 0, 0, .05);
        }

        .admin-chat-ui .ac-bubble.user {
            background: var(--ac-white);
            border: 1px solid var(--ac-border);
            color: var(--ac-text);
        }

        .admin-chat-ui .ac-bubble.admin {
            background: var(--ac-primary);
            color: #fff;
        }

        .admin-chat-ui .ac-bubble-meta {
            display: block;
            margin-top: 4px;
            font-size: 11px;
            opacity: .75;
        }

        .admin-chat-ui .ac-input-wrap {
            border-top: 1px solid var(--ac-border);
            background: var(--ac-white);
            padding: 12px;
        }

        .admin-chat-ui .ac-input-form {
            display: flex;
            gap: 8px;
        }

        .admin-chat-ui .ac-input {
            height: 44px !important;
            min-height: 44px;
            border: 1px solid #d5dee8 !important;
            border-radius: 10px !important;
            background: var(--ac-bg) !important;
            color: var(--ac-text) !important;
            padding: 0 12px !important;
            font-size: 14px;
            outline: none;
            width: 100%;
            box-shadow: none !important;
        }

        .admin-chat-ui .ac-input:focus {
            border-color: var(--ac-primary) !important;
        }

        .admin-chat-ui .ac-send {
            height: 44px;
            border: 0;
            border-radius: 10px;
            background: var(--ac-primary);
            color: #fff;
            font-size: 14px;
            font-weight: 600;
            padding: 0 16px;
            white-space: nowrap;
        }

        .admin-chat-ui .ac-send:hover {
            background: var(--ac-primary-dark);
        }

        .admin-chat-ui .ac-empty {
            height: 460px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: var(--ac-muted);
            padding: 16px;
            background: var(--ac-bg);
        }

        .admin-chat-ui .ac-error {
            margin-top: 6px;
            color: #b91c1c;
            font-size: 12px;
        }

        .admin-chat-ui .ac-empty-page {
            background: var(--ac-white);
            border: 1px solid var(--ac-border);
            border-radius: 12px;
            padding: 40px 16px;
            text-align: center;
            color: var(--ac-muted);
        }

        @media (max-width: 991.98px) {
            .admin-chat-ui .ac-layout {
                grid-template-columns: 1fr;
                min-height: auto;
            }

            .admin-chat-ui .ac-session-list {
                max-height: 320px;
            }

            .admin-chat-ui .ac-messages,
            .admin-chat-ui .ac-empty {
                height: 360px;
            }
        }

        @media (max-width: 575.98px) {
            .admin-chat-ui {
                padding: 12px;
            }

            .admin-chat-ui .ac-header {
                padding: 12px;
            }

            .admin-chat-ui .ac-title {
                font-size: 20px;
            }

            .admin-chat-ui .ac-input-form {
                flex-direction: column;
            }

            .admin-chat-ui .ac-send {
                width: 100%;
            }
        }
    </style>

    <div class="admin-chat-ui">
        <div class="ac-header">
            <div>
                <h1 class="ac-title">Support Inbox</h1>
                <p class="ac-subtitle">Manage customer conversations in one place.</p>
            </div>
            <div class="ac-badge">
                <span class="ac-badge-dot"></span>
                {{ $unreadCount }} unread
            </div>
        </div>

        @if(empty($sessions))
            <div class="ac-empty-page">No conversations yet. Waiting for customer messages.</div>
        @else
            <div class="ac-layout">
                <div class="ac-panel">
                    <div class="ac-panel-head">
                        <p class="ac-panel-title">Conversations</p>
                        <p class="ac-panel-meta">{{ count($sessions) }} active chat{{ count($sessions) === 1 ? '' : 's' }}</p>
                    </div>
                    <div class="ac-session-list" wire:poll.3s="refreshChatData">
                        @foreach($sessions as $session)
                            <button
                                type="button"
                                wire:click="selectSession('{{ $session['session_id'] }}')"
                                class="ac-session-item {{ $selectedSession === $session['session_id'] ? 'is-active' : '' }}"
                            >
                                <div class="ac-session-row">
                                    <div class="ac-avatar">{{ strtoupper(substr($session['name'], 0, 1)) }}</div>
                                    <div class="ac-session-content">
                                        <div class="ac-session-top">
                                            <p class="ac-name">{{ $session['name'] }}</p>
                                            <p class="ac-time">{{ $session['last_time'] }}</p>
                                        </div>
                                        <p class="ac-email">{{ $session['email'] }}</p>
                                        <p class="ac-preview">{{ $session['last_message'] }}</p>
                                    </div>
                                    @if($session['unread_count'] > 0)
                                        <span class="ac-unread">{{ $session['unread_count'] }}</span>
                                    @endif
                                </div>
                            </button>
                        @endforeach
                    </div>
                </div>

                <div class="ac-panel">
                    @if($selectedSession && !empty($activeUser))
                        <div class="ac-chat-head">
                            <div class="ac-chat-user">
                                <div class="ac-avatar">{{ strtoupper(substr($activeUser['name'], 0, 1)) }}</div>
                                <div>
                                    <p class="ac-name">{{ $activeUser['name'] }}</p>
                                    <p class="ac-email">{{ $activeUser['email'] }}</p>
                                </div>
                            </div>
                            <span class="ac-status">Active chat</span>
                        </div>

                        <div class="ac-messages" wire:poll.3s="refreshChatData">
                            @foreach($messages as $message)
                                @if($message['sender_type'] === 'user')
                                    <div class="ac-message-row user">
                                        <div class="ac-bubble user">
                                            {{ $message['message'] }}
                                            <span class="ac-bubble-meta">
                                                {{ $message['name'] ?: 'Customer' }} • {{ \Carbon\Carbon::parse($message['created_at'])->format('g:i A') }}
                                            </span>
                                        </div>
                                    </div>
                                @else
                                    <div class="ac-message-row admin">
                                        <div class="ac-bubble admin">
                                            {{ $message['message'] }}
                                            <span class="ac-bubble-meta">
                                                Support Team • {{ \Carbon\Carbon::parse($message['created_at'])->format('g:i A') }}
                                            </span>
                                        </div>
                                    </div>
                                @endif
                            @endforeach

                            @if(empty($messages))
                                <div class="ac-empty">No messages yet. Send the first reply.</div>
                            @endif
                        </div>

                        <div class="ac-input-wrap">
                            <form wire:submit.prevent="sendMessage" class="ac-input-form">
                                <input type="text" wire:model="newMessage" placeholder="Write a helpful response..." class="ac-input">
                                <button type="submit" class="ac-send">Send message</button>
                            </form>
                            @error('newMessage')
                                <p class="ac-error">{{ $message }}</p>
                            @enderror
                        </div>
                    @else
                        <div class="ac-empty">Select a conversation to view messages.</div>
                    @endif
                </div>
            </div>
        @endif
    </div>

    @if(config('broadcasting.connections.pusher.key'))
        <script src="https://js.pusher.com/8.4.0/pusher.min.js"></script>
        <script>
            document.addEventListener('livewire:initialized', () => {
                const listenerKey = '__adminChatRealtimeBound';

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

                const channel = window.__ckPusher.subscribe('chat.admin.inbox');
                channel.bind('chat.message.sent', () => {
                    Livewire.dispatch('refreshAdminInbox');
                });
            });
        </script>
    @endif
</div>
