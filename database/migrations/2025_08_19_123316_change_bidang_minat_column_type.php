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
        Schema::table('pengajuan_pembimbings', function (Blueprint $table) {
            // Mengubah kolom 'bidang_minat' menjadi tipe ENUM dan mengizinkan nilai NULL
            $table->enum('bidang_minat', ['RPL', 'Kecerdasan Buatan', 'Jaringan', 'Hardware'])->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengajuan_pembimbings', function (Blueprint $table) {
            // Mengembalikan kolom 'bidang_minat' ke tipe string saat di-rollback
            $table->string('bidang_minat')->change();
        });
    }
};
