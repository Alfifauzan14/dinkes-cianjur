<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('regulasis', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('category'); // e.g. PERATURAN BUPATI, KEPUTUSAN BUPATI
            $table->string('topic');    // e.g. PERBUP STUNTING, KIA, GERMAS
            $table->text('description');
            $table->integer('year');
            $table->string('cover_path')->nullable();
            $table->string('file_path');
            $table->string('file_size');
            $table->string('status')->default('Berlaku'); // Berlaku, Tidak Berlaku
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('regulasis');
    }
};
