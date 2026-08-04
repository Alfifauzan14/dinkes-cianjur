<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jenis_faskes', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });

        Schema::create('kecamatans', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });

        Schema::table('faskes', function (Blueprint $table) {
            $table->string('type')->change();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jenis_faskes');
        Schema::dropIfExists('kecamatans');
        
        Schema::table('faskes', function (Blueprint $table) {
            $table->enum('type', ['Rumah Sakit', 'Puskesmas'])->change();
        });
    }
};
