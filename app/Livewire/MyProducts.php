<?php

namespace App\Livewire;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class MyProducts extends Component  // 👈 Perhatikan nama class ini
{
    // Fungsi untuk daftar jadi penjual
    public function registerAsSeller()
    {
        $user = Auth::user();
        $user->seller_status = 'pending';
        $user->save();

        session()->flash('message', 'Permintaan pendaftaran berhasil dikirim. Tunggu verifikasi admin ya!');
    }

    // Fungsi Hapus Barang
    public function delete($id)
    {
        $product = Product::findOrFail($id);

        if ($product->user_id !== Auth::id()) {
            abort(403);
        }

        if (is_array($product->images)) {
            foreach ($product->images as $image) {
                Storage::disk('public')->delete($image);
            }
        }

        $product->delete();

        session()->flash('message', 'Barang berhasil dihapus.');
    }

    public function render()
    {
        $user = Auth::user();
        
        $products = Product::where('user_id', $user->id)
            ->latest()
            ->get();

        // 👇 Perhatikan nama view di sini sesuaikan dengan nama file blade Abang
        return view('livewire.my-products', [ 
            'products' => $products,
            'user' => $user,
        ])->layout('layouts.app'); 
    }
}