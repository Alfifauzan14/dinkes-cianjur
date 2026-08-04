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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('site_name')->default('Dinas Kesehatan Kabupaten Cianjur');
            $table->string('site_tagline')->default('Mewujudkan masyarakat Cianjur yang sehat, mandiri, dan berkeadilan.');
            $table->string('site_logo')->nullable();
            $table->string('address')->default('Jl. Pangeran No. 105, Cianjur, Jawa Barat.');
            $table->string('phone')->default('(0263) 261XXX');
            $table->string('email')->default('kontak@dinkes.cianjurkab.go.id');
            $table->string('emergency_call')->default('119');
            $table->string('emergency_title')->default('Ambulans Gawat Darurat: PSC 119 Cianjur');
            $table->string('social_facebook')->default('https://facebook.com');
            $table->string('social_instagram')->default('https://instagram.com');
            $table->string('social_twitter')->default('https://x.com');
            $table->string('social_youtube')->default('https://youtube.com');
            $table->string('social_tiktok')->default('https://tiktok.com');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
