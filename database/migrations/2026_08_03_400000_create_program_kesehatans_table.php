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
        Schema::create('program_kesehatans', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('subtitle')->nullable();

            // 3 optional data cards for indicators
            $table->string('stat_1_num')->nullable();
            $table->string('stat_1_label')->nullable();
            $table->string('stat_2_num')->nullable();
            $table->string('stat_2_label')->nullable();
            $table->string('stat_3_num')->nullable();
            $table->string('stat_3_label')->nullable();

            $table->text('content')->nullable(); // Main description / article
            $table->json('intervensi')->nullable(); // JSON list of interventions
            $table->string('status')->default('published'); // 'published', 'draft'
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('program_kesehatans');
    }
};
