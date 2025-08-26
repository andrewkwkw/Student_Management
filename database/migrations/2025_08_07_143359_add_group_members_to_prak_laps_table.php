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
            $table->foreignId('user_id_mhs_2')->nullable()->after('user_id')->constrained('users')->onDelete('set null');
            $table->foreignId('user_id_mhs_3')->nullable()->after('user_id_mhs_2')->constrained('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('praktik_lapangs', function (Blueprint $table) {
            $table->dropForeign(['user_id_mhs_2']);
            $table->dropForeign(['user_id_mhs_3']);
            $table->dropColumn('user_id_mhs_2');
            $table->dropColumn('user_id_mhs_3');
        });
    }
};
