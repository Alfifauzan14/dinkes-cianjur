<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('ppid_settings', function (Blueprint $table) {
            if (Schema::hasColumn('ppid_settings', 'page_title')) {
                $table->dropColumn('page_title');
            }
            if (Schema::hasColumn('ppid_settings', 'page_subtitle')) {
                $table->dropColumn('page_subtitle');
            }
        });
    }

    public function down(): void
    {
        Schema::table('ppid_settings', function (Blueprint $table) {
            if (! Schema::hasColumn('ppid_settings', 'page_title')) {
                $table->string('page_title')->nullable();
            }
            if (! Schema::hasColumn('ppid_settings', 'page_subtitle')) {
                $table->text('page_subtitle')->nullable();
            }
        });
    }
};
