<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class ProductList extends Component
{
    public function render()
    {
        return view('livewire.product-list', [
            // Ambil produk terbaru & aktif, beserta relasi kategorinya
            'products' => Product::with('category')
                ->where('is_active', true)
                ->latest()
                ->get()
        ]);
    }
}