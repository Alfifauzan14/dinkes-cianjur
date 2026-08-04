<?php

namespace Database\Seeders;

use App\Models\HomeInfoCard;
use Illuminate\Database\Seeder;

class HomeInfoCardSeeder extends Seeder
{
    public function run(): void
    {
        $cards = [
            [
                'title' => 'Peta Sebaran Faskes',
                'description' => 'Temukan lokasi puskesmas & faskes terdekat di Kabupaten Cianjur.',
                'icon_name' => 'map',
                'order_index' => 1,
            ],
            [
                'title' => 'Layanan Darurat 119',
                'description' => 'Respon cepat tanggap darurat PSC 119 terintegrasi 24 jam penuh.',
                'icon_name' => 'phone',
                'order_index' => 2,
            ],
            [
                'title' => 'Akses Satu Data',
                'description' => 'Unduh profil kesehatan daerah, regulasi, & transparansi informasi.',
                'icon_name' => 'document',
                'order_index' => 3,
            ],
        ];

        foreach ($cards as $card) {
            HomeInfoCard::create($card);
        }
    }
}
