<div>
    <!-- Floating Chat Button -->
    <div wire:click="toggleChat" 
         style="position: fixed !important; bottom: 24px !important; right: 24px !important; z-index: 99999 !important; background: linear-gradient(135deg, #3b82f6 0%, #8b5cf6 100%) !important; width: 64px !important; height: 64px !important; border-radius: 50% !important; display: flex !important; align-items: center !important; justify-content: center !important; box-shadow: 0 10px 25px rgba(0,0,0,0.3) !important; cursor: pointer !important; transition: all 0.3s ease !important;"
         onmouseover="this.style.transform='scale(1.1)'" 
         onmouseout="this.style.transform='scale(1)'">
        <svg style="width: 32px !important; height: 32px !important; color: white !important;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
        </svg>
        @if(!$isOpen)
            <span style="position: absolute !important; top: -4px !important; right: -4px !important; background: #ef4444 !important; color: white !important; font-size: 12px !important; border-radius: 50% !important; width: 20px !important; height: 20px !important; display: flex !important; align-items: center !important; justify-content: center !important; animation: pulse 2s infinite !important;">
                1
            </span>
        @endif
    </div>

    <!-- Chat Window -->
    @if($isOpen)
        <div style="position: fixed !important; bottom: 96px !important; right: 24px !important; width: 384px !important; background: white !important; border-radius: 8px !important; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25) !important; z-index: 99999 !important; border: 1px solid #e5e7eb !important;">
            <!-- Chat Header -->
            <div style="background: linear-gradient(135deg, #3b82f6 0%, #8b5cf6 100%) !important; color: white !important; padding: 16px !important; border-radius: 8px 8px 0 0 !important; display: flex !important; justify-content: space-between !important; align-items: center !important;">
                <div>
                    <h3 style="font-weight: 600 !important; font-size: 18px !important; margin: 0 !important;">Live Chat Support</h3>
                    <p style="font-size: 14px !important; opacity: 0.9 !important; margin: 4px 0 0 0 !important;">We typically reply in minutes</p>
                </div>
                <button wire:click="toggleChat" style="background: none !important; border: none !important; color: white !important; cursor: pointer !important; padding: 8px !important; border-radius: 50% !important; transition: background-color 0.3s !important;" onmouseover="this.style.backgroundColor='rgba(255,255,255,0.2)'" onmouseout="this.style.backgroundColor='transparent'">
                    <svg style="width: 20px !important; height: 20px !important;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- User Info Form (if not provided) -->
            @if(!$hasUserInfo)
                <div class="p-4 border-b border-gray-200 bg-gray-50">
                    <p class="text-sm text-gray-600 mb-3">Please provide your details to start chatting:</p>
                    <form wire:submit.prevent="saveUserInfo">
                        <input type="text" 
                               wire:model="userName" 
                               placeholder="Your Name" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md mb-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <input type="email" 
                               wire:model="userEmail" 
                               placeholder="Your Email" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md mb-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <button type="submit" 
                                class="w-full bg-gradient-to-r from-blue-500 to-purple-600 text-white py-2 rounded-md hover:opacity-90 transition-opacity">
                            Start Chatting
                        </button>
                    </form>
                    @error('userName') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    @error('userEmail') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
            @endif

            <!-- Messages Area -->
            <div class="h-80 overflow-y-auto p-4 space-y-3" id="chatMessages">
                @foreach($messages as $message)
                    @if($message['sender_type'] === 'user')
                        <div class="flex justify-start">
                            <div class="bg-gray-100 rounded-lg p-3 max-w-xs">
                                <p class="text-sm font-medium text-gray-800">{{ $message['name'] ?? 'Guest' }}</p>
                                <p class="text-gray-700">{{ $message['message'] }}</p>
                                <p class="text-xs text-gray-500 mt-1">{{ \Carbon\Carbon::parse($message['created_at'])->format('h:i A') }}</p>
                            </div>
                        </div>
                    @else
                        <div class="flex justify-end">
                            <div class="bg-gradient-to-r from-blue-500 to-purple-600 text-white rounded-lg p-3 max-w-xs">
                                <p class="text-sm font-medium">Support Team</p>
                                <p>{{ $message['message'] }}</p>
                                <p class="text-xs opacity-75 mt-1">{{ \Carbon\Carbon::parse($message['created_at'])->format('h:i A') }}</p>
                            </div>
                        </div>
                    @endif
                @endforeach
                
                @if(empty($messages))
                    <div class="text-center text-gray-500 py-8">
                        <svg class="w-12 h-12 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                        </svg>
                        <p class="text-sm">Start a conversation with our support team!</p>
                    </div>
                @endif
            </div>

            <!-- Message Input -->
            @if($hasUserInfo)
                <div class="p-4 border-t border-gray-200">
                    <form wire:submit.prevent="sendMessage" class="flex gap-2">
                        <input type="text" 
                               wire:model="newMessage" 
                               placeholder="Type your message..." 
                               class="flex-1 px-3 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <button type="submit" 
                                class="bg-gradient-to-r from-blue-500 to-purple-600 text-white px-4 py-2 rounded-full hover:opacity-90 transition-opacity">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                            </svg>
                        </button>
                    </form>
                    @error('newMessage') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
            @endif
        </div>
    @endif

    <!-- Auto-scroll & polling script -->
    <script>
        document.addEventListener('livewire:init', () => {
            // Poll for new messages every 3 seconds
            setInterval(() => {
                @this.loadMessages();
            }, 3000);

            // Scroll to bottom after sending message
            Livewire.on('messageSent', () => {
                setTimeout(() => {
                    const chatMessages = document.getElementById('chatMessages');
                    if (chatMessages) {
                        chatMessages.scrollTop = chatMessages.scrollHeight;
                    }
                }, 100);
            });

            // Optional: highlight new admin messages
            Livewire.on('newAdminMessage', () => {
                const messages = document.querySelectorAll('#chatMessages > div');
                if (messages.length > 0) {
                    const lastMessage = messages[messages.length - 1];
                    if (lastMessage && lastMessage.querySelector('.text-white')) {  // admin message
                        lastMessage.style.backgroundColor = '#dcfce7';
                        setTimeout(() => {
                            lastMessage.style.backgroundColor = '';
                        }, 3000);
                    }
                }
            });
        });
    </script>
</div>