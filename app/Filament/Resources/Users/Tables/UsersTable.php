<?php

namespace App\Filament\Resources\Users\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;



class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
        ->columns([
            TextColumn::make('name')
                ->searchable()
                ->sortable(),

            TextColumn::make('email')
                ->searchable()
                ->limit(25),

            TextColumn::make('nim')
                ->label('NIM')
                ->searchable()
                ->sortable()
                ->alignCenter()
                ->width(140)
                ->placeholder('-'),

            TextColumn::make('major')
                ->label('Jurusan')
                ->searchable()
                ->wrap()
                ->limit(20)
                ->placeholder('-'),

            TextColumn::make('seller_status')
                ->badge()
                ->alignCenter(),

            TextColumn::make('email_verified_at')
                ->dateTime()
                ->sortable()
                ->since(), // 👈 lebih ringkas

            ToggleColumn::make('is_student_verified')
                    ->label('Verifikasi Mahasiswa')
                    ->onColor('success') // Hijau kalau on
                    ->offColor('danger') // Merah kalau off
                    ->sortable(),
        ])

            ->actions([ // ✅ v4
                EditAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
