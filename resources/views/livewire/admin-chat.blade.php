<div class="h-screen bg-gray-100 p-8">
    <h1 class="text-2xl font-bold mb-4">Admin Chat Interface</h1>
    
    @if(empty($sessions))
        <div class="bg-white p-6 rounded-lg shadow">
            <p class="text-gray-500">No conversations yet. Waiting for customer messages...</p>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Conversations List -->
            <div class="bg-white rounded-lg shadow">
                <div class="p-4 border-b">
                    <h2 class="font-semibold">Conversations ({{ count($sessions) }})</h2>
                </div>
                <div class="max-h-96 overflow-y-auto">
                    @foreach($sessions as $session)
                        <div wire:click="selectSession('{{ $session['session_id'] }}')" 
                             class="p-4 border-b cursor-pointer hover:bg-gray-50 {{ $selectedSession === $session['session_id'] ? 'bg-blue-50' : '' }}">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center text-white font-bold">
                                    {{ strtoupper(substr($session['name'], 0, 1)) }}
                                </div>
                                <div class="flex-1">
                                    <div class="font-medium">{{ $session['name'] }}</div>
                                    <div class="text-sm text-gray-500">{{ $session['email'] }}</div>
                                    <div class="text-sm text-gray-600 truncate">{{ $session['last_message'] }}</div>
                                </div>
                                @if($session['unread_count'] > 0)
                                    <span class="bg-red-500 text-white text-xs px-2 py-1 rounded-full">
                                        {{ $session['unread_count'] }}
                                    </span>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Chat Area -->
            <div class="bg-white rounded-lg shadow">
                @if($selectedSession && !empty($activeUser))
                    <div class="p-4 border-b">
                        <h3 class="font-semibold">{{ $activeUser['name'] }}</h3>
                        <p class="text-sm text-gray-500">{{ $activeUser['email'] }}</p>
                    </div>
                    
                    <div class="h-96 overflow-y-auto p-4 space-y-3">
                        @foreach($messages as $message)
                            @if($message['sender_type'] === 'user')
                                <div class="flex justify-start">
                                    <div class="bg-gray-200 rounded-lg p-3 max-w-xs">
                                        <p class="text-sm">{{ $message['message'] }}</p>
                                        <p class="text-xs text-gray-500 mt-1">{{ $message['name'] }}</p>
                                    </div>
                                </div>
                            @else
                                <div class="flex justify-end">
                                    <div class="bg-blue-500 text-white rounded-lg p-3 max-w-xs">
                                        <p class="text-sm">{{ $message['message'] }}</p>
                                        <p class="text-xs text-blue-100 mt-1">Support Team</p>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                        
                        @if(empty($messages))
                            <div class="text-center text-gray-500 py-8">
                                <p>No messages yet. Start the conversation!</p>
                            </div>
                        @endif
                    </div>
                    
                    <div class="p-4 border-t">
                        <form wire:submit.prevent="sendMessage" class="flex space-x-2">
                            <input type="text" wire:model="newMessage" 
                                   placeholder="Type your message..." 
                                   class="flex-1 px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                                Send
                            </button>
                        </form>
                        @error('newMessage')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                @else
                    <div class="h-96 flex items-center justify-center text-gray-500">
                        <div class="text-center">
                            <p>Select a conversation to start chatting</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    @endif
</div>
