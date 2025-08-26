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
        Schema::table('pengajuan_sk_pembimbings', function (Blueprint $table) {
            // Tambahkan kolom sk_pembimbing untuk menyimpan path file SK
            $table->string('sk_pembimbing')->nullable()->after('bukti_bimbingan_2');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengajuan_sk_pembimbings', function (Blueprint $table) {
            // Hapus kolom sk_pembimbing jika migrasi di-rollback
            $table->dropColumn('sk_pembimbing');
        });
    }
};
