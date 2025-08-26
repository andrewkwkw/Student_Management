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
        // Hapus kolom nama dan npm yang tidak diperlukan dari tabel
        Schema::table('praktik_lapangs', function (Blueprint $table) {
            $table->dropColumn(['nama_mhs_1', 'npm_mhs_1', 'nama_mhs_2', 'npm_mhs_2', 'nama_mhs_3', 'npm_mhs_3']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Tambahkan kembali kolom yang dihapus
        Schema::table('praktik_lapangs', function (Blueprint $table) {
            $table->string('nama_mhs_1')->nullable();
            $table->string('npm_mhs_1')->nullable();
            $table->string('nama_mhs_2')->nullable();
            $table->string('npm_mhs_2')->nullable();
            $table->string('nama_mhs_3')->nullable();
            $table->string('npm_mhs_3')->nullable();
        });
    }
};
