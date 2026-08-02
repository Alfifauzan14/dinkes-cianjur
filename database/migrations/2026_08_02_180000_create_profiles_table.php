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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            
            // Sambutan Kepala Dinas
            $table->string('kepala_dinas_name');
            $table->string('kepala_dinas_role');
            $table->string('sambutan_title');
            $table->text('sambutan_quote');
            $table->text('sambutan_desc_1');
            $table->text('sambutan_desc_2');
            $table->string('kepala_dinas_image')->nullable();
            
            // Sejarah / Profil
            $table->string('sejarah_title');
            $table->text('sejarah_text_1');
            $table->text('sejarah_text_2');
            $table->string('sejarah_image')->nullable();
            
            // Visi & Statistik
            $table->text('visi_title');
            $table->text('visi_desc');
            $table->string('stat_1_text');
            $table->string('stat_2_text');
            
            // Misi (Dynamic JSON Array)
            $table->json('misi')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
