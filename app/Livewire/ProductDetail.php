<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Conversation;
use Illuminate\Support\Facades\Auth;

class ProductDetail extends Component
{
    public $product;

    public function mount($slug)
    {
        // Cari produk berdasarkan slug, kalau tidak ada -> 404 Not Found
        $this->product = Product::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();
    }
    // Jangan lupa import


public function startChat()
{
    if (!Auth::check()) {
        return redirect()->route('login');
    }

    // Cek apakah user mau chat sama diri sendiri
    if (Auth::id() == $this->product->user_id) {
        return; // Atau kasih notif error
    }

    // 1. Cek apakah percakapan udah pernah ada sebelumnya?
    $conversation = Conversation::where('buyer_id', Auth::id())
        ->where('seller_id', $this->product->user_id)
        ->first();

    // 2. Kalau belum ada, bikin baru
    if (!$conversation) {
        $conversation = Conversation::create([
            'buyer_id' => Auth::id(),
            'seller_id' => $this->product->user_id, // Asumsi di tabel products kolomnya user_id
            'product_id' => $this->product->id,
        ]);
    }

    // 3. Redirect ke halaman chat tadi
    return redirect()->route('chat', ['id' => $conversation->id]);
}

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.product-detail');
    }
}