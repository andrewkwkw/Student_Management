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
        Schema::table('praktik_lapangs', function (Blueprint $table) {
            // Tambahkan kolom dosen_pembimbing
            $table->string('dosen_pembimbing')->nullable()->after('alamat_instansi'); // Tambahkan setelah alamat_instansi
            
            // Tambahkan kolom status_pl dengan enum
            // Default 'Diajukan' karena saat mahasiswa submit, status awalnya adalah diajukan
            $table->enum('status_pl', ['Diajukan', 'Diterima', 'Ditolak'])->default('Diajukan')->after('dosen_pembimbing'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('praktik_lapangs', function (Blueprint $table) {
            // Hapus kolom jika migrasi di-rollback
            $table->dropColumn('dosen_pembimbing');
            $table->dropColumn('status_pl');
        });
    }
};

