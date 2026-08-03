<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('layanan_terpadus', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type'); // Warga, Faskes, Nakes
            $table->string('icon'); // Key for SVG/Icon map
            $table->string('link')->nullable(); // Optional target URL
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('layanan_terpadus');
    }
};
