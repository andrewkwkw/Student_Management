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
            // Menambahkan kolom 'bidang_minat' sebagai string setelah kolom 'judul_sk'
            $table->string('bidang_minat')->after('judul_sk')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengajuan_pembimbings', function (Blueprint $table) {
            // Menghapus kolom 'bidang_minat' jika migrasi di-rollback
            $table->dropColumn('bidang_minat');
        });
    }
};

