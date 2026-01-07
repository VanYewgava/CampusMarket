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
            // Cek dulu biar gak error kalau kolomnya udah ada
            if (!Schema::hasColumn('users', 'university_id')) {
                $table->string('university_id')->nullable();
            }
            if (!Schema::hasColumn('users', 'nim')) {
                $table->string('nim')->nullable();
            }
            if (!Schema::hasColumn('users', 'major')) {
                $table->string('major')->nullable();
            }
            if (!Schema::hasColumn('users', 'phone')) {
                $table->string('phone')->nullable();
            }
            if (!Schema::hasColumn('users', 'is_student_verified')) {
                $table->boolean('is_student_verified')->default(false);
            }
            // Kolom seller_status sepertinya sudah ada (karena tadi bisa disave), tapi jaga-jaga:
            if (!Schema::hasColumn('users', 'seller_status')) {
                $table->string('seller_status')->default('none');
            }
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
