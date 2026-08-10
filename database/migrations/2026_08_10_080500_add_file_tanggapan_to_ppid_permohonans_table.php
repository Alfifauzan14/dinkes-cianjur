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
        Schema::table('ppid_permohonans', function (Blueprint $table) {
            $table->string('file_tanggapan')->nullable()->after('tanggapan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ppid_permohonans', function (Blueprint $table) {
            $table->dropColumn('file_tanggapan');
        });
    }
};
