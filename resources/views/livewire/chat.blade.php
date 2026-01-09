<div class="max-w-4xl mx-auto py-6 px-4" wire:poll.2s>
    <div class="bg-white rounded-lg shadow-lg overflow-hidden h-[500px] flex flex-col">
        
        <div class="bg-orange-600 p-4 text-white font-bold flex justify-between">
            <span>
                Chatting dengan 
                {{ Auth::id() == $conversation->buyer_id ? $conversation->seller->name : $conversation->buyer->name }}
            </span>
            <a href="{{ route('dashboard') }}" class="text-xs bg-orange-700 px-2 py-1 rounded">Kembali</a>
        </div>

        <div class="flex-1 p-4 overflow-y-auto bg-gray-100 space-y-4" id="chatContainer">
            @foreach($messages as $msg)
                @php
                    // Cek apakah pesan ini dari SAYA (User yang sedang login)
                    $isMe = $msg->sender_id == auth()->id();
                @endphp
                <div class="flex w-full {{ $isMe ? 'justify-end' : 'justify-start' }}">
                    <div class="relative max-w-[70%] px-4 py-2 rounded-xl shadow-sm border
                        {{ $isMe 
                            ? 'bg-orange-600 text-white border-orange-600 rounded-tr-none' 
                            : 'bg-white text-gray-800 border-gray-200 rounded-tl-none'    
                        }}">
                        @if(!$isMe)
                            <p class="text-[10px] font-bold text-orange-600 mb-1">
                                {{ $msg->sender->name }}
                            </p>
                        @endif
                        <p class="text-sm leading-relaxed">
                            {{ $msg->body }}
                        </p>
                        <div class="mt-1 text-right">
                            <span class="text-[10px] {{ $isMe ? 'text-orange-100' : 'text-gray-400' }}">
                                {{ $msg->created_at->format('H:i') }}
                                @if($isMe)
                                    <span class="ml-1">✓</span>
                                @endif
                            </span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="p-4 bg-white border-t">
            <form wire:submit.prevent="sendMessage" class="flex gap-2">
                <input wire:model="body" type="text" 
                    class="flex-1 rounded-full border-gray-300 focus:border-orange-500 focus:ring-orange-500" 
                    placeholder="Tulis pesan..." required>
                
                <button type="submit" class="bg-orange-600 text-white p-2 rounded-full hover:bg-orange-700 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                </button>
            </form>
        </div>
    </div>
    
    <script>
        document.addEventListener('livewire:initialized', () => {
            const chatContainer = document.getElementById('chatContainer');
            chatContainer.scrollTop = chatContainer.scrollHeight;
        });
    </script>
</div>