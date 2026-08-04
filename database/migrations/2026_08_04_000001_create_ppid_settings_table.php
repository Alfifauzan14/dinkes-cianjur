<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ppid_settings', function (Blueprint $table) {
            $table->id();

            // Header
            $table->string('page_title')->default('PPID Dinas Kesehatan Kabupaten Cianjur');
            $table->text('page_subtitle')->nullable();

            // Stats Section
            $table->string('stat_1_number')->default('9.757');
            $table->text('stat_1_desc')->nullable();
            $table->string('stat_2_number')->default('8.089.450');
            $table->text('stat_2_desc')->nullable();
            $table->string('stat_3_number')->default('8.118.414');
            $table->text('stat_3_desc')->nullable();

            // Informasi Tautan Section
            $table->string('tautan_badge')->nullable();
            $table->string('tautan_title')->nullable();
            $table->text('tautan_subtitle')->nullable();

            // Tautan Cards (5 cards)
            $table->string('tautan_1_label')->nullable();
            $table->string('tautan_1_url')->nullable();
            $table->string('tautan_2_label')->nullable();
            $table->string('tautan_2_url')->nullable();
            $table->string('tautan_3_label')->nullable();
            $table->string('tautan_3_url')->nullable();
            $table->string('tautan_4_label')->nullable();
            $table->string('tautan_4_url')->nullable();
            $table->string('tautan_5_label')->nullable();
            $table->string('tautan_5_url')->nullable();

            // Tata Cara Section
            $table->string('tata_cara_badge')->nullable();
            $table->string('tata_cara_heading')->nullable();
            $table->string('tata_cara_card_1_title')->nullable();
            $table->text('tata_cara_card_1_text')->nullable();
            $table->string('tata_cara_card_2_title')->nullable();
            $table->text('tata_cara_card_2_text')->nullable();
            $table->string('tata_cara_card_3_title')->nullable();
            $table->text('tata_cara_card_3_text')->nullable();
            $table->string('tata_cara_card_4_title')->nullable();
            $table->text('tata_cara_card_4_text')->nullable();

            // Action Buttons
            $table->string('btn_daftar_label')->nullable();
            $table->string('btn_daftar_url')->nullable();
            $table->string('btn_login_label')->nullable();
            $table->string('btn_login_url')->nullable();

            // Accordion Items (6 items)
            $table->string('accordion_1_title')->nullable();
            $table->text('accordion_1_content')->nullable();
            $table->string('accordion_2_title')->nullable();
            $table->text('accordion_2_content')->nullable();
            $table->string('accordion_3_title')->nullable();
            $table->text('accordion_3_content')->nullable();
            $table->string('accordion_4_title')->nullable();
            $table->text('accordion_4_content')->nullable();
            $table->string('accordion_5_title')->nullable();
            $table->text('accordion_5_content')->nullable();
            $table->string('accordion_6_title')->nullable();
            $table->text('accordion_6_content')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ppid_settings');
    }
};
