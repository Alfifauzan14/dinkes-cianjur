<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('faskes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('type', ['Rumah Sakit', 'Puskesmas']);
            $table->string('kecamatan');
            $table->string('address');
            $table->string('phone')->nullable();
            $table->string('jam_operasional')->nullable();
            $table->decimal('lat', 10, 7);
            $table->decimal('lng', 10, 7);
            $table->string('layanan')->nullable();
            $table->string('akreditasi')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('faskes');
    }
};
