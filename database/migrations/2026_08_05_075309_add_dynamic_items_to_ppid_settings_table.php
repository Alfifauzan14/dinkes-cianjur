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
        Schema::table('ppid_settings', function (Blueprint $table) {
            $table->json('tautan_items')->nullable();
            $table->json('tata_cara_items')->nullable();
            $table->string('tata_cara_image')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ppid_settings', function (Blueprint $table) {
            $table->dropColumn(['tautan_items', 'tata_cara_items', 'tata_cara_image']);
        });
    }
};
