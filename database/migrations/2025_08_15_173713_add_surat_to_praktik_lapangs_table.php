<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('praktik_lapangs', function (Blueprint $table) {
            $table->string('campus_approval_path')->nullable()->after('sipu_path');
            $table->string('institution_approval_path')->nullable()->after('campus_approval_path');
        });
    }

    public function down(): void
    {
        Schema::table('praktik_lapangs', function (Blueprint $table) {
            $table->dropColumn('campus_approval_path');
            $table->dropColumn('institution_approval_path');
        });
    }
};
