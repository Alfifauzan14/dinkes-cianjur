<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kategoris', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('type'); // berita, program, regulasi, laporan
            $table->string('warna')->default('#009966'); // hex color for badge
            $table->timestamps();
        });

        // Seed default categories
        DB::table('kategoris')->insert([
            // Berita
            ['nama' => 'Kesehatan',   'type' => 'berita',   'warna' => '#009966', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Kegiatan',    'type' => 'berita',   'warna' => '#0284C7', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Pengumuman',  'type' => 'berita',   'warna' => '#D97706', 'created_at' => now(), 'updated_at' => now()],
            // Program
            ['nama' => 'Gizi & Stunting',    'type' => 'program',  'warna' => '#7C3AED', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Imunisasi',           'type' => 'program',  'warna' => '#0284C7', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Kesehatan Ibu & Anak', 'type' => 'program',  'warna' => '#DB2777', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Penyakit Menular',    'type' => 'program',  'warna' => '#DC2626', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Penyakit Tidak Menular', 'type' => 'program', 'warna' => '#D97706', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Kesehatan Lingkungan', 'type' => 'program',  'warna' => '#009966', 'created_at' => now(), 'updated_at' => now()],
            // Regulasi
            ['nama' => 'Peraturan Daerah',    'type' => 'regulasi', 'warna' => '#1D4ED8', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Peraturan Bupati',    'type' => 'regulasi', 'warna' => '#0284C7', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Surat Edaran',        'type' => 'regulasi', 'warna' => '#D97706', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Keputusan Kepala Dinas', 'type' => 'regulasi', 'warna' => '#7C3AED', 'created_at' => now(), 'updated_at' => now()],
            // Laporan
            ['nama' => 'Laporan Kinerja',     'type' => 'laporan',  'warna' => '#009966', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Laporan Keuangan',    'type' => 'laporan',  'warna' => '#0284C7', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Laporan Tahunan',     'type' => 'laporan',  'warna' => '#7C3AED', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Laporan Bulanan',     'type' => 'laporan',  'warna' => '#D97706', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('kategoris');
    }
};
