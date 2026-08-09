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
        Schema::table('statistik_settings', function (Blueprint $table) {
            $table->string('status_badge')->nullable()->default(null)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('statistik_settings', function (Blueprint $table) {
            $table->string('status_badge')->default('Data Riil Semester I 2026')->change();
        });
    }
};
