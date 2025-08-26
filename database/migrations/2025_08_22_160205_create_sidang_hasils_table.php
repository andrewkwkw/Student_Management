<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sidang_hasils', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('bukti_acc_1')->nullable();
            $table->string('bukti_acc_2')->nullable();
            $table->string('bukti_bimbingan_1')->nullable();
            $table->string('bukti_bimbingan_2')->nullable();
            $table->string('nilai_sidang_hasil')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sidang_hasils');
    }
};

