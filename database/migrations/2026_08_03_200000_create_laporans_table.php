<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('laporans', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('category'); // e.g. Laporan Kinerja, Laporan Keuangan, Informasi Publik
            $table->string('file_path');
            $table->string('file_size');
            $table->date('release_date');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('laporans');
    }
};
