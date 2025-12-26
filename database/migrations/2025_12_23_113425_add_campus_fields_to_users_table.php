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
        Schema::table('users', function (Blueprint $table) {
            // Relasi ke tabel universities
            $table->foreignId('university_id')->nullable()->constrained()->nullOnDelete();

            // Data Akademik
            $table->string('nim')->nullable();
            $table->string('major')->nullable();
            $table->string('phone')->nullable();

            // Status Verifikasi Mahasiswa
            $table->boolean('is_student_verified')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
