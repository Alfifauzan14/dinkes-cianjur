<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('laporans', function (Blueprint $table) {
            $table->bigInteger('views')->default(0);
            $table->bigInteger('downloads')->default(0);
        });

        Schema::table('regulasis', function (Blueprint $table) {
            $table->bigInteger('views')->default(0);
            $table->bigInteger('downloads')->default(0);
        });
    }

    public function down(): void
    {
        Schema::table('regulasis', function (Blueprint $table) {
            $table->dropColumn(['views', 'downloads']);
        });

        Schema::table('laporans', function (Blueprint $table) {
            $table->dropColumn(['views', 'downloads']);
        });
    }
};
