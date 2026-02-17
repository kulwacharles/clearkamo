<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 p-6">
    <div class="max-w-7xl mx-auto">
        <!-- Modern Header -->
        <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden mb-6">
            <div class="bg-gradient-to-r from-blue-600 via-purple-600 to-indigo-600 text-white p-8">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="bg-white/20 backdrop-blur-sm rounded-full p-3">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold">Admin Chat Center</h2>
                            <p class="text-blue-100 text-sm">Manage customer conversations in real-time</p>
                        </div>
                    </div>
                    @if($unreadCount > 0)
                        <div class="flex items-center space-x-2 bg-red-500 px-4 py-2 rounded-full">
                            <div class="w-2 h-2 bg-white rounded-full animate-pulse"></div>
                            <span class="text-white font-medium">{{ $unreadCount }} unread</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden" style="height: 700px;">
            <div class="flex h-full">
                <!-- Modern Sidebar -->
                <div class="w-1/3 bg-gradient-to-b from-gray-50 to-white border-r border-gray-200">
                    <div class="p-6 border-b border-gray-200 bg-white">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-3.356l-1.4-1.4A3 3 0 0012 7.5V4a3 3 0 00-3-3H4a3 3 0 00-3 3v3.5a3 3 0 005.356 3.356l1.4 1.4A3 3 0 0012 16.5V20z"></path>
                                </svg>
                                Conversations
                            </h3>
                            <span class="bg-blue-100 text-blue-600 text-xs px-2 py-1 rounded-full font-medium">
                                {{ count($sessions) }} active
                            </span>
                        </div>
                    </div>
                
                @if(empty($sessions))
                    <div class="p-8 text-center text-gray-500">
                        <svg class="w-12 h-12 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 00-2 2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 00-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                        </svg>
                        <p class="text-sm">No conversations yet</p>
                    </div>
                @else
                    <div class="p-4 space-y-3 overflow-y-auto" style="max-height: 500px;">
                        @foreach($sessions as $session)
                            <div wire:click="selectSession('{{ $session['session_id'] }}')"
                                 class="group cursor-pointer transition-all duration-200 {{ $selectedSession === $session['session_id'] ? 'bg-gradient-to-r from-blue-50 to-indigo-50 border-l-4 border-blue-500' : 'hover:bg-gray-50 border-l-4 border-transparent' }} border-l-4 rounded-r-lg">
                                <div class="p-4">
                                    <div class="flex items-start justify-between mb-3">
                                        <div class="flex items-center space-x-3">
                                            <div class="relative">
                                                <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center text-white font-semibold text-sm">
                                                    {{ strtoupper(substr($session['name'], 0, 1)) }}
                                                </div>
                                                @if($session['unread_count'] > 0)
                                                    <div class="absolute -top-1 -right-1 w-3 h-3 bg-red-500 rounded-full border-2 border-white animate-pulse"></div>
                                                @endif
                                            </div>
                                            <div>
                                                <h4 class="font-semibold text-gray-800 text-sm">{{ $session['name'] }}</h4>
                                                <p class="text-xs text-gray-500">{{ $session['email'] }}</p>
                                            </div>
                                        </div>
                                        <div class="flex flex-col items-end space-y-1">
                                            @if($session['unread_count'] > 0)
                                                <span class="bg-red-500 text-white text-xs px-2 py-1 rounded-full font-medium animate-pulse">
                                                    {{ $session['unread_count'] }} new
                                                </span>
                                            @endif
                                            <span class="text-xs text-gray-400">
                                                {{ $session['last_time'] }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <div class="flex-1">
                                            <p class="text-sm text-gray-600 line-clamp-2">{{ $session['last_message'] }}</p>
                                        </div>
                                        <div class="flex items-center space-x-2">
                                            @if($session['message_count'] > 1)
                                                <span class="bg-blue-100 text-blue-600 text-xs px-2 py-1 rounded-full font-medium">
                                                    {{ $session['message_count'] }}
                                                </span>
                                            @else
                                                <span class="bg-blue-100 text-blue-600 text-xs px-2 py-1 rounded-full font-medium">
                                                    1
                                                </span>
                                            @endif
                                            <svg class="w-4 h-4 text-gray-400 group-hover:text-blue-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                @endif
            </div>

            <!-- Chat Area -->
            <div class="flex-1 flex flex-col">
                @if($selectedSession)
                    <!-- Modern Chat Header -->
                    <div class="bg-gradient-to-r from-blue-600 via-purple-600 to-indigo-600 text-white p-6 shadow-lg">
                        <div class="flex justify-between items-center">
                            <div class="flex items-center space-x-3">
                                <div class="bg-white/20 backdrop-blur-sm rounded-full p-2">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0v4a4 4 0 018 0v4a4 4 0 01-8 0v-4a4 4 0 018 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-lg">
                                        {{ $sessions[array_search($selectedSession, array_column($sessions, 'session_id'))]['name'] ?? 'Unknown User' }}
                                    </h3>
                                    <p class="text-blue-100 text-sm">
                                        {{ $sessions[array_search($selectedSession, array_column($sessions, 'session_id'))]['email'] ?? '' }}
                                    </p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-2">
                                <button wire:click="deleteSession('{{ $selectedSession }}')" 
                                        class="bg-red-500 hover:bg-red-600 text-white p-2 rounded-lg transition-colors shadow-lg"
                                        onclick="return confirm('Are you sure you want to delete this conversation?')">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6a4 4 0 004 4h6a4 4 0 004-4v-1.172a2 2 0 00-.64-1.759L17 5z"></path>
                                    </svg>
                                </button>
                                <div class="bg-white/20 backdrop-blur-sm rounded-lg px-3 py-1">
                                    <span class="text-xs text-white font-medium">Active Chat</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modern Messages Area -->
                    <div class="flex-1 overflow-y-auto p-6 space-y-4 bg-gradient-to-b from-gray-50 to-white" style="max-height: 400px;">
                        @foreach($messages as $message)
                            @if($message['sender_type'] === 'user')
                                <div class="flex justify-start">
                                    <div class="max-w-md">
                                        <div class="flex items-end space-x-2 mb-2">
                                            <div class="bg-gray-100 rounded-full p-2">
                                                <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0v4a4 4 0 018 0v4a4 4 0 01-8 0v-4a4 4 0 018 0z"></path>
                                                </svg>
                                            </div>
                                            <div class="text-xs text-gray-500">
                                                {{ \Carbon\Carbon::parse($message['created_at'])->format('h:i A') }}
                                            </div>
                                        </div>
                                        <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-4">
                                            <div class="font-semibold text-gray-800 text-sm mb-1">{{ $message['name'] }}</div>
                                            <div class="text-gray-700 text-sm">{{ $message['message'] }}</div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="flex justify-end">
                                    <div class="max-w-md">
                                        <div class="flex items-start space-x-2 mb-2 justify-end">
                                            <div class="bg-gradient-to-r from-blue-600 to-purple-600 rounded-full p-2">
                                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2l-4-4m6 2l-4 4m0-10a2 2 0 00-2 2h-1a2 2 0 00-2 2H9a2 2 0 00-2-2H6a2 2 0 00-2 2v1a2 2 0 002 2z"></path>
                                                </svg>
                                            </div>
                                            <div class="text-xs text-white/80">
                                                {{ \Carbon\Carbon::parse($message['created_at'])->format('h:i A') }}
                                            </div>
                                        </div>
                                        <div class="bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-2xl shadow-lg p-4">
                                            <div class="font-semibold text-sm mb-1">Support Team</div>
                                            <div>{{ $message['message'] }}</div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                        
                        @if(empty($messages))
                            <div class="text-center py-12">
                                <div class="bg-gray-100 rounded-full w-16 h-16 mx-auto mb-4 flex items-center justify-center">
                                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                    </svg>
                                </div>
                                <p class="text-gray-500 text-sm">No messages in this conversation yet</p>
                                <p class="text-gray-400 text-xs mt-2">Select a conversation from the sidebar to start chatting</p>
                            </div>
                        @endif
                    </div>

                    <!-- Modern Message Input -->
                    @if($hasUserInfo)
                        <div class="p-6 border-t border-gray-200 bg-white">
                            <form wire:submit.prevent="sendMessage" class="flex gap-3">
                                <div class="flex-1 relative">
                                    <input type="text" 
                                           wire:model="newMessage" 
                                           placeholder="Type your reply..." 
                                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent shadow-sm">
                                    <button type="submit" 
                                            class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-gradient-to-r from-blue-600 to-purple-600 text-white p-2 rounded-lg hover:shadow-lg transition-all duration-200">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9 18"></path>
                                        </svg>
                                    </button>
                                </div>
                            </form>
                            @error('newMessage') <span class="text-red-500 text-xs mt-2">{{ $message }}</span> @endif
                        </div>
                    @endif
                @else
                    <!-- No Session Selected -->
                    <div class="flex-1 flex items-center justify-center text-gray-500">
                        <div class="text-center">
                            <svg class="w-16 h-16 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                            </svg>
                            <p class="text-lg font-medium">Select a conversation to start chatting</p>
                            <p class="text-sm mt-2">Choose from the active conversations on the left</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Auto-refresh and scroll -->
<script>
    document.addEventListener('livewire:init', () => {
        // Auto-refresh every 2 seconds for better real-time experience
        setInterval(() => {
            @this.loadSessions();
            @this.loadUnreadCount();
            if (@this.selectedSession) {
                @this.loadMessages();
            }
        }, 2000);

        // Show browser notification for new messages
        Livewire.on('echo-notification', () => {
            // Play notification sound (optional)
            const audio = new Audio('data:audio/wav;base64,UklGRnoGAABXQVZFZm10IBAAAAABAAEAQB8AAEAfAAABAAgAZGF0YQoGAACBhYqFbF1fdJivrJBhNjVgodDbq2EcBj+a2/LDciUFLIHO8tiJNwgZaLvt559NEAxQp+PwtmMcBjiR1/LMeSwFJHfH8N2QQAoUXrTp66hVFApGn+DyvmwhBSuBzvLZi');
            audio.play().catch(e => console.log('Audio play failed:', e));
            
            // Show browser notification
            if ('Notification' in window && Notification.permission === 'granted') {
                new Notification('New Chat Message', {
                    body: 'You have a new message from a customer',
                    icon: '/favicon.ico'
                });
            }
        });

        // Request notification permission
        if ('Notification' in window && Notification.permission === 'default') {
            Notification.requestPermission();
        }

        // Auto-scroll to bottom when new message is sent
        Livewire.on('messageSent', () => {
            setTimeout(() => {
                const messagesContainer = document.querySelector('.overflow-y-auto');
                if (messagesContainer) {
                    messagesContainer.scrollTop = messagesContainer.scrollHeight;
                }
            }, 100);
        });

        // Highlight new messages
        Livewire.on('refreshChatData', () => {
            const messages = document.querySelectorAll('.overflow-y-auto > div');
            if (messages.length > 0) {
                const lastMessage = messages[messages.length - 1];
                lastMessage.style.backgroundColor = '#fef3c7';
                setTimeout(() => {
                    lastMessage.style.backgroundColor = '';
                }, 2000);
            }
        });
    });
</script>
