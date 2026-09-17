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
        Schema::table('info_cards', function (Blueprint $table) {
            $table->string('link_url', 500)->nullable()->after('icon_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('info_cards', function (Blueprint $table) {
            $table->dropColumn('link_url');
        });
    }
};
