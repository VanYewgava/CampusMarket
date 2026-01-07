<?php

namespace App\Livewire;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\Attributes\Layout;

class MyProducts extends Component
{
    public function registerAsSeller()
    {
        $user = Auth::user();
        
        if ($user->seller_status === 'none') {
            $user->update(['seller_status' => 'pending']);
            session()->flash('message', 'Permintaan Anda terkirim! Tunggu Admin menyetujui akun Anda.');
        }
    }
    // Hapus Produk
    public function delete($id)
    {
        $product = Product::where('user_id', Auth::id())->find($id);
        
        if ($product) {
            $product->delete();
            session()->flash('message', 'Produk berhasil dihapus.');
        }
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.my-products', [
            // Ambil hanya produk milik user yang sedang login
            'products' => Product::where('user_id', Auth::id())->latest()->get(),
            'user' => Auth::user()
        ]);
    }
}