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
        Schema::create('stunting_records', function (Blueprint $table) {
            $table->id();
            $table->integer('year')->unique();
            $table->float('rate');
            $table->boolean('is_highlighted')->default(false);
            $table->timestamps();
        });

        Schema::create('statistik_settings', function (Blueprint $table) {
            $table->id();
            
            // Subheader
            $table->string('status_badge')->default('Data Riil Semester I 2026');
            
            // Card 1: Puskesmas
            $table->string('stat_1_num')->default('47');
            $table->string('stat_1_badge')->default('100% Aktif!');
            $table->string('stat_1_caption')->default('Seluruhnya Terakreditasi Paripurna');
            
            // Card 2: RS Rujukan
            $table->string('stat_2_num')->default('8');
            $table->string('stat_2_badge')->default('Mitra BPJS');
            $table->string('stat_2_caption')->default('4 RSUD Pemda + 4 RS Swasta');
            
            // Card 3: SDM Kesehatan
            $table->string('stat_3_num')->default('3,820');
            $table->string('stat_3_badge')->default('Tersertifikasi');
            $table->string('stat_3_caption')->default('Dokter, Perawat, Bidan, & Apoteker');
            
            // Card 4: Imunisasi
            $table->string('stat_4_num')->default('94.8%');
            $table->string('stat_4_badge')->default('+3.2% YoY');
            $table->string('stat_4_caption')->default('Target Nasional 2026: 95.0%');
            
            // Stunting Chart Texts
            $table->string('stunting_title')->default('Tren Penurunan Prevalensi Stunting');
            $table->string('stunting_subtitle')->default('Target Daerah Cianjur 2026: <10%');
            $table->string('stunting_trend_badge')->default('Tren Positif');
            $table->text('stunting_footer_note')->default('Penurunan sebesar -8.4% dalam 2 tahun melalui Program Pendampingan Keluarga Terpadu.');
            
            // Progress Bar Lists (Casted JSON arrays)
            $table->json('nakes_data')->nullable();
            $table->json('sebaran_data')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stunting_records');
        Schema::dropIfExists('statistik_settings');
    }
};
