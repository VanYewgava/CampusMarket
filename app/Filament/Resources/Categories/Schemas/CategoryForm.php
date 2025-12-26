<?php

namespace App\Filament\Resources\Categories\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->schema([
                        // 1. INPUT NAMA (Auto Slug)
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true) // Logic jalan saat pindah kolom
                            ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state))),

                        // 2. INPUT SLUG (Readonly)
                        TextInput::make('slug')
                            ->required()
                            ->maxLength(255)
                            ->readOnly(),

                        // 3. INPUT ICON
                        TextInput::make('icon')
                            ->maxLength(255)
                            ->placeholder('Contoh: heroicon-o-book-open'),

                        // 4. TOGGLE AKTIF
                        Toggle::make('is_active')
                            ->required()
                            ->default(true),
                    ])
            ]);
    }
}
