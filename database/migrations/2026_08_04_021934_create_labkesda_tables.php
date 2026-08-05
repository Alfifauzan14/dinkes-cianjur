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
        Schema::create('labkesda_settings', function (Blueprint $table) {
            $table->id();
            $table->string('alamat')->nullable();
            $table->string('jam_operasional')->nullable();
            $table->string('kontak')->nullable();
            $table->timestamps();
        });

        Schema::create('labkesda_categories', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('badge_text')->nullable();
            $table->string('button_text')->nullable();
            $table->string('button_url')->nullable();
            $table->string('icon_name')->default('science');
            $table->integer('order_index')->default(0);
            $table->timestamps();
        });

        Schema::create('labkesda_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('labkesda_category_id')->constrained('labkesda_categories')->onDelete('cascade');
            $table->string('item_name');
            $table->integer('order_index')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('labkesda_items');
        Schema::dropIfExists('labkesda_categories');
        Schema::dropIfExists('labkesda_settings');
    }
};
