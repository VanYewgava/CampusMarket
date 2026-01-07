<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Hash;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                /* ================= INFORMASI USER ================= */
                Section::make('Informasi User')
                    ->columns(2)
                    ->components([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('email')
                            ->email()
                            ->required()
                            ->unique(ignoreRecord: true),

                        TextInput::make('phone')
                            ->tel(),

                        Select::make('seller_status')
                            ->options([
                                'none'     => 'None',
                                'pending'  => 'Pending',
                                'approved' => 'Approved',
                            ])
                            ->default('none')
                            ->required(),
                    ]),

                /* ================= DATA MAHASISWA ================= */
                Section::make('Data Mahasiswa')
                    ->columns(2)
                    ->components([
                        TextInput::make('nim')
                            ->label('NIM')
                            ->maxLength(20),

                        TextInput::make('major')
                            ->label('Jurusan')
                            ->maxLength(100),

                        TextInput::make('university_id')
                            ->label('ID Universitas')
                            ->numeric(),

                        Toggle::make('is_student_verified')
                            ->label('Mahasiswa Terverifikasi'),
                    ]),

                /* ================= KEAMANAN ================= */
                Section::make('Keamanan')
                    ->components([
                        TextInput::make('password')
                            ->password()
                            ->dehydrateStateUsing(fn ($state) =>
                                filled($state) ? Hash::make($state) : null
                            )
                            ->required(fn (string $context): bool =>
                                $context === 'create'
                            )
                            ->hiddenOn('edit'),
                    ]),

                /* ================= SISTEM ================= */
                Section::make('Sistem')
                    ->collapsed()
                    ->components([
                        DateTimePicker::make('email_verified_at')
                            ->label('Email Verified At'),

                        DateTimePicker::make('two_factor_confirmed_at')
                            ->label('2FA Confirmed At'),
                    ]),
            ]);
    }
}
