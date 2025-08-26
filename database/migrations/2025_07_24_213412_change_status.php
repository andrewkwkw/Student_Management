<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeStatus extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('status_aktif', ['aktif', 'tidak_aktif'])->default('true')->change();
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Kembalikan ke integer jika perlu rollback
            $table->integer('status_aktif')->default(1)->change();
        });
    }
}
