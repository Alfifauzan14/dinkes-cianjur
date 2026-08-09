<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('layanan_terpadus', function (Blueprint $table) {
            $table->text('requirements')->nullable()->after('description');
            $table->text('procedures')->nullable()->after('requirements');
            $table->string('processing_time')->nullable()->after('procedures');
            $table->string('tariff')->nullable()->after('processing_time');
            $table->string('helpdesk_email')->nullable()->after('tariff');
            $table->string('helpdesk_phone')->nullable()->after('helpdesk_email');
        });
    }

    public function down(): void
    {
        Schema::table('layanan_terpadus', function (Blueprint $table) {
            $table->dropColumn([
                'requirements',
                'procedures',
                'processing_time',
                'tariff',
                'helpdesk_email',
                'helpdesk_phone',
            ]);
        });
    }
};
