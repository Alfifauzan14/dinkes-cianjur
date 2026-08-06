<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('statistik_settings', function (Blueprint $table) {
            $table->json('indikator_data')->nullable()->after('status_badge');
        });

        // Migrate existing stat_1..stat_4 data into indikator_data JSON
        $row = DB::table('statistik_settings')->first();
        if ($row) {
            $indikatorData = [];
            for ($i = 1; $i <= 4; $i++) {
                $indikatorData[] = [
                    'name' => $row->{"stat_{$i}_badge"} ?? '',
                    'num' => $row->{"stat_{$i}_num"} ?? '',
                    'caption' => $row->{"stat_{$i}_caption"} ?? '',
                ];
            }
            DB::table('statistik_settings')
                ->where('id', $row->id)
                ->update(['indikator_data' => json_encode($indikatorData)]);
        }
    }

    public function down(): void
    {
        Schema::table('statistik_settings', function (Blueprint $table) {
            $table->dropColumn('indikator_data');
        });
    }
};
