<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('ppid_settings', function (Blueprint $table) {
            $table->string('email_ppid')->nullable()->after('tata_cara_image');
        });
    }

    public function down(): void
    {
        Schema::table('ppid_settings', function (Blueprint $table) {
            $table->dropColumn('email_ppid');
        });
    }
};
