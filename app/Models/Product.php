<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'category_id', 'name', 'slug', 
        'description', 'price', 'condition', 
        'is_active', 'is_bargainable', 'images'
    ];

    // Wajib di-cast agar array JSON bisa dibaca PHP
    protected $casts = [
        'images' => 'array',
        'is_active' => 'boolean',
        'is_bargainable' => 'boolean',
    ];

    // Produk milik satu User (Penjual)
    public function seller()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Produk masuk satu Kategori
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}