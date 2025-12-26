<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            
            // Relasi: Milik Siapa? Kategori Apa?
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('category_id')->nullable()->constrained()->nullOnDelete();
            
            // Info Produk
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->decimal('price', 12, 2); // Harga (12 digit, 2 desimal)
            $table->enum('condition', ['new', 'used'])->default('used'); // Bekas/Baru
            
            // Fitur
            $table->boolean('is_active')->default(true);
            $table->boolean('is_bargainable')->default(false); // Bisa Nego?
            
            // Gambar (Array)
            $table->json('images')->nullable(); 
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
