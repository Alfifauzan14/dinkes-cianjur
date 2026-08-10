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
        Schema::create('ppid_permohonans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pemohon');
            $table->string('nik', 16);
            $table->string('no_hp');
            $table->string('email')->nullable();
            $table->string('pekerjaan');
            $table->string('cara_memperoleh');
            $table->string('cara_informasi')->nullable();
            $table->string('bentuk_informasi')->nullable();
            $table->text('alamat');
            $table->string('foto_ktp');
            $table->string('jenis_informasi');
            $table->string('tujuan_penggunaan');
            $table->text('rincian_informasi');
            $table->text('alasan_permohonan')->nullable();
            $table->text('format_informasi')->nullable(); // stored as comma-separated or json
            $table->string('status')->default('pending'); // pending, disetujui, ditolak
            $table->text('tanggapan')->nullable(); // admin response
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ppid_permohonans');
    }
};
