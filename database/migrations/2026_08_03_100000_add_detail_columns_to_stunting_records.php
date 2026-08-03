<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('stunting_records', function (Blueprint $table) {
            $table->integer('total_balita')->nullable()->after('rate');
            $table->integer('balita_stunting')->nullable()->after('total_balita');
            $table->string('wilayah_terendah')->nullable()->after('balita_stunting');
            $table->string('wilayah_tertinggi')->nullable()->after('wilayah_terendah');
            $table->text('catatan')->nullable()->after('wilayah_tertinggi');
        });
    }

    public function down(): void
    {
        Schema::table('stunting_records', function (Blueprint $table) {
            $table->dropColumn(['total_balita', 'balita_stunting', 'wilayah_terendah', 'wilayah_tertinggi', 'catatan']);
        });
    }
};
