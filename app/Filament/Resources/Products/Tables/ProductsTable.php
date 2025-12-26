<?php

namespace App\Filament\Resources\Products\Tables;

use App\Models\Product;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class ProductsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('images')
                    ->circular()
                    ->stacked() // Foto menumpuk cantik
                    ->limit(3), // Tampilkan max 3 foto

                TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->description(fn (Product $record): string => Str::limit(strip_tags($record->description), 30)),

                TextColumn::make('category.name') // Menampilkan nama kategori
                    ->sortable()
                    ->badge(), // Tampil seperti label warna

                TextColumn::make('price')
                    ->money('IDR') // Format otomatis Rp ...
                    ->sortable(),

                TextColumn::make('seller.name') // Menampilkan nama penjual
                    ->label('Penjual'),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
