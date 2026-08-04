<?php

namespace Database\Seeders;

use App\Models\StatistikSetting;
use Illuminate\Database\Seeder;

class StatistikSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        StatistikSetting::updateOrCreate(
            ['id' => 1],
            [
                'status_badge' => 'Data Riil Semester I 2026',
                'stat_1_num' => '47',
                'stat_1_badge' => '100% Aktif!',
                'stat_1_caption' => 'Seluruhnya Terakreditasi Paripurna',
                'stat_2_num' => '8',
                'stat_2_badge' => 'Mitra BPJS',
                'stat_2_caption' => '4 RSUD Pemda + 4 RS Swasta',
                'stat_3_num' => '3,820',
                'stat_3_badge' => 'Tersertifikasi',
                'stat_3_caption' => 'Dokter, Perawat, Bidan, & Apoteker',
                'stat_4_num' => '94.8%',
                'stat_4_badge' => '+3.2% YoY',
                'stat_4_caption' => 'Target Nasional 2026: 95.0%',
                'stunting_title' => 'Tren Penurunan Prevalensi Stunting',
                'stunting_subtitle' => 'Target Daerah Cianjur 2026: <10%',
                'stunting_trend_badge' => 'Tren Positif',
                'stunting_footer_note' => 'Penurunan sebesar -8.4% dalam 2 tahun melalui Program Pendampingan Keluarga Terpadu.',
                'nakes_data' => [
                    ['name' => 'Perawat Kesehatan', 'value' => '1,604 (42%)', 'width' => 42],
                    ['name' => 'Bidan Desa & Puskesmas', 'value' => '1,184 (31%)', 'width' => 31],
                    ['name' => 'Dokter Umum & Spesialis', 'value' => '573 (15%)', 'width' => 15],
                    ['name' => 'Apoteker & Tenaga Kefarmasian', 'value' => '459 (12%)', 'width' => 12],
                ],
                'sebaran_data' => [
                    ['name' => 'Zonasi Selatan', 'value' => '17 Puskesmas (36%)', 'width' => 36],
                    ['name' => 'Zonasi Utara', 'value' => '16 Puskesmas (34%)', 'width' => 34],
                    ['name' => 'Zonasi Tengah', 'value' => '14 Puskesmas (30%)', 'width' => 30],
                ],
            ]
        );
    }
}
