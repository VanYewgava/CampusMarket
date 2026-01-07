<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads; // Wajib untuk upload file
use Livewire\Attributes\Layout;

class ProductCreate extends Component
{
    use WithFileUploads;

    // Properti Form
    public $name;
    public $price;
    public $description;
    public $category_id;
    public $condition = 'used'; // Default 'Bekas'
    public $images = []; // Array untuk menampung banyak foto

    // Validasi
    protected $rules = [
        'name' => 'required|min:5|max:255',
        'price' => 'required|numeric|min:1000',
        'category_id' => 'required|exists:categories,id',
        'condition' => 'required|in:new,used',
        'description' => 'required|min:10',
        'images.*' => 'image|max:2048', // Max 2MB per foto
        'images' => 'required|array|min:1|max:5', // Minimal 1 foto, Max 5
    ];

    public function save()
    {
        $this->validate();

        // 1. Proses Upload Gambar
        $imagePaths = [];
        foreach ($this->images as $image) {
            // Simpan ke folder 'products' di disk public
            $imagePaths[] = $image->store('products', 'public');
        }

        // 2. Buat Slug Unik
        $slug = Str::slug($this->name) . '-' . Str::random(5);

        // 3. Simpan ke Database
        Product::create([
            'user_id' => Auth::id(), // Milik user yang sedang login
            'category_id' => $this->category_id,
            'name' => $this->name,
            'slug' => $slug,
            'price' => $this->price,
            'condition' => $this->condition,
            'description' => $this->description,
            'images' => $imagePaths, // Laravel otomatis ubah array jadi JSON (karena cast di Model)
            'is_active' => true,
        ]);

        // 4. Redirect kembali ke Dashboard
        return redirect()->route('dashboard')->with('message', 'Barang berhasil ditambahkan!');
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.product-create', [
            'categories' => Category::where('is_active', true)->get()
        ]);
    }
}