<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class University extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email_domain', 'website', 'is_active'];

    // Satu kampus punya banyak mahasiswa
    public function students()
    {
        return $this->hasMany(User::class);
    }
}
