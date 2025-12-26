<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Produk')
                ->schema([
                    // 1. Pilih Penjual (Admin bisa pilih siapa pemilik barang ini)
                    Select::make('user_id')
                        ->relationship('seller', 'name') // Mengambil nama dari relasi 'seller' (User)
                        ->searchable()
                        ->required()
                        ->label('Penjual (Mahasiswa)'),

                    // 2. Pilih Kategori
                    Select::make('category_id')
                        ->relationship('category', 'name')
                        ->searchable()
                        ->preload()
                        ->required(),

                    // 3. Nama Produk (Auto Slug)
                    TextInput::make('name')
                        ->required()
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state))),

                    TextInput::make('slug')
                        ->readOnly()
                        ->required(),

                    // 4. Harga (Ada prefix Rp)
                    TextInput::make('price')
                        ->numeric()
                        ->prefix('Rp')
                        ->required(),

                    // 5. Kondisi (Baru/Bekas)
                    Select::make('condition')
                        ->options([
                            'new' => 'Baru',
                            'used' => 'Bekas',
                        ])
                        ->required(),

                    // 6. Deskripsi
                    RichEditor::make('description')
                        ->columnSpanFull(), // Lebar penuh
                ]),
                Section::make('Foto Produk')
                ->schema([
                    // 7. Upload Banyak Foto sekaligus
                    FileUpload::make('images')
                        ->disk('public')
                        ->multiple() // Boleh lebih dari 1
                        ->directory('products') // Masuk folder storage/app/public/products
                        ->maxFiles(5)
                        ->reorderable()
                        ->columnSpanFull(),
                ])
            ]);
    }
}
