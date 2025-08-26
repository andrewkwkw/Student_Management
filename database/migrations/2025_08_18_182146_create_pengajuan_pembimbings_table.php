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
        Schema::create('pengajuan_pembimbings', function (Blueprint $table) {
            $table->id(); // bigint auto increment, primary key
            $table->unsignedBigInteger('user_id'); // relasi ke users
            $table->string('judul_sk', 255);
            $table->string('dosen_1', 255);
            $table->string('dosen_2', 255)->nullable();
            $table->enum('status_pengajuan', ['Diajukan', 'Diterima', 'Ditolak'])->default('Diajukan');
            $table->timestamps();

            // foreign key ke tabel users
            $table->foreign('user_id')
                  ->references('id')->on('users')
                  ->onDelete('cascade'); // kalau user dihapus, pengajuan ikut hilang
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_pembimbings');
    }
};
