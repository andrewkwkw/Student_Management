<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi.
     */
    public function up(): void
    {
        // Ubah nama kolom 'user_id' menjadi 'user_id_mhs_1'
        Schema::table('praktik_lapangs', function (Blueprint $table) {
            $table->renameColumn('user_id', 'user_id_mhs_1');
        });
    }

    /**
     * Balikkan migrasi.
     */
    public function down(): void
    {
        // Kembalikan nama kolom dari 'user_id_mhs_1' menjadi 'user_id'
        Schema::table('praktik_lapangs', function (Blueprint $table) {
            $table->renameColumn('user_id_mhs_1', 'user_id');
        });
    }
};
