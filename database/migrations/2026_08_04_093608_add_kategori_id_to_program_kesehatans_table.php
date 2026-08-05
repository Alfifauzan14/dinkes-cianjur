<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('program_kesehatans', function (Blueprint $table) {
            $table->string('kategori')->nullable()->after('slug');
            $table->string('icon')->nullable()->after('kategori'); // material icon name
        });
    }

    public function down(): void
    {
        Schema::table('program_kesehatans', function (Blueprint $table) {
            $table->dropColumn(['kategori', 'icon']);
        });
    }
};
