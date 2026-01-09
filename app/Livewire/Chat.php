<?php

namespace App\Livewire;

use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Chat extends Component
{
    public $conversation;
    public $body; // Isi pesan yang mau dikirim

    public function mount($id)
    {
        // Cari percakapan berdasarkan ID, pastikan user yang login berhak akses
        $this->conversation = Conversation::findOrFail($id);
        
        if(Auth::id() !== $this->conversation->buyer_id && Auth::id() !== $this->conversation->seller_id) {
            abort(403);
        }
    }

    public function sendMessage()
    {
        $this->validate(['body' => 'required|string']);

        Message::create([
            'conversation_id' => $this->conversation->id,
            'sender_id' => Auth::id(),
            'body' => $this->body,
        ]);

        $this->body = ''; // Reset input
    }

    public function render()
    {
        return view('livewire.chat', [
            // Ambil pesan, urutkan dari lama ke baru
            'messages' => $this->conversation->messages()->with('sender')->get()
        ])->layout('layouts.app'); // Pakai layout dashboard biar rapi
    }
}