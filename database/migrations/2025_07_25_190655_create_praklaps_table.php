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
        Schema::create('praktik_lapangs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Mahasiswa yang submit form
            $table->enum('skema', ['Instansi', 'Sekolah', 'UMKM']);
            $table->string('sipu_path')->nullable(); // Path file SIPU jika UMKM
            $table->string('nama_instansi')->nullable(); // Nama Instansi/UMKM
            $table->string('alamat_instansi'); // Alamat Instansi

            // Data Mahasiswa 1 (Wajib)
            $table->string('nama_mhs_1');
            $table->string('npm_mhs_1');

            // Data Mahasiswa 2 (Opsional)
            $table->string('nama_mhs_2')->nullable();
            $table->string('npm_mhs_2')->nullable();

            // Data Mahasiswa 3 (Opsional)
            $table->string('nama_mhs_3')->nullable();
            $table->string('npm_mhs_3')->nullable();

            $table->date('tanggal_pelaksanaan');
            $table->timestamps(); // created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('praktik_lapangs');
    }
};

