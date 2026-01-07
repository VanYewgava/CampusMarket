<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\Attributes\Layout;

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

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.product-detail');
    }
}