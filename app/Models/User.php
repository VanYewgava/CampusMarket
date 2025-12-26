<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Spatie\Permission\Traits\HasRoles;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Validation\ValidationException; 

class User extends Authenticatable implements FilamentUser
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, TwoFactorAuthenticatable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'university_id',
        'nim',
        'major',
        'phone',
        'is_student_verified',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'two_factor_secret',
        'two_factor_recovery_codes',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the user's initials
     */
    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->take(2)
            ->map(fn ($word) => Str::substr($word, 0, 1))
            ->implode('');
    }

    public function canAccessPanel(Panel $panel): bool
    {
        // Hanya user dengan role 'admin' yang boleh masuk panel Admin
        // User lain (mahasiswa) akan ditolak (403 Forbidden)
        return $this->hasRole('admin');
    }

    public function university()
    {
        return $this->belongsTo(University::class);
    }



    protected static function booted()
    {
        static::creating(function ($user) {
            if ($user->email) {
                $domain = substr(strrchr($user->email, "@"), 1);
                $univ = University::where('email_domain', $domain)->first();
                
                if ($univ) {
                    // Jika ketemu, verifikasi
                    $user->university_id = $univ->id;
                    $user->is_student_verified = true;
                } else {
                    // JIKA TIDAK KETEMU -> LEMPAR ERROR (Gagal Daftar)
                    // Hapus bagian 'else' ini jika ingin pakai Mode Fleksibel
                    throw ValidationException::withMessages([
                        'email' => 'Maaf, domain email kampus ini belum terdaftar di sistem kami.',
                    ]);
                }
            }
        });
    }
}
