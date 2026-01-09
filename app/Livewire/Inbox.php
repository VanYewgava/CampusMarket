<?php

namespace App\Livewire;

use App\Models\Conversation;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Inbox extends Component
{
    public function render()
    {
        // Ambil semua percakapan di mana user ini terlibat (sebagai buyer ATAU seller)
        $conversations = Conversation::where('buyer_id', Auth::id())
            ->orWhere('seller_id', Auth::id())
            ->with(['buyer', 'seller', 'messages' => function($query) {
                // Ambil pesan terakhir buat preview
                $query->latest(); 
            }])
            ->latest() // Urutkan dari yang terbaru
            ->get();

        return view('livewire.inbox', [
            'conversations' => $conversations
        ])->layout('layouts.app');
    }
}