<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ppid_keberatans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('permohonan_id')
                ->constrained('ppid_permohonans')
                ->cascadeOnDelete();
            $table->string('token', 7);          // token permohonan (denormalized for lookup)
            $table->string('email', 255);         // email pemohon (verifikasi)
            $table->text('alasan_keberatan');
            $table->string('status')->default('pending'); // pending, ditanggapi
            $table->text('tanggapan_admin')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ppid_keberatans');
    }
};
