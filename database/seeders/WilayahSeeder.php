<?php

namespace Database\Seeders;

use App\Models\Wilayah;
use Illuminate\Database\Seeder;

class WilayahSeeder extends Seeder
{
    public function run(): void
    {
        // 29 dari 32 kecamatan di Kabupaten Cianjur.
        // Cilaku & Naringgul sengaja belum dimasukkan karena data
        // koordinat Puskesmas-nya belum terverifikasi akurat, silakan
        // tambahkan manual setelah dicek langsung di Google Maps.
        $wilayah = [
            'Cianjur',
            'Cipanas',
            'Cugenang',
            'Pacet',
            'Sukaresmi',
            'Cikalongkulon',
            'Mande',
            'Karangtengah',
            'Sukaluyu',
            'Ciranjang',
            'Bojongpicung',
            'Haurwangi',
            'Warungkondang',
            'Gekbrong',
            'Cibeber',
            'Campaka',
            'Campakamulya',
            'Cijati',
            'Sukanagara',
            'Takokak',
            'Kadupandak',
            'Pagelaran',
            'Tanggeung',
            'Pasirkuda',
            'Cibinong',
            'Cidaun',
            'Sindangbarang',
            'Agrabinta',
            'Leles',
        ];

        foreach ($wilayah as $nama) {
            Wilayah::create(['nama' => $nama]);
        }
    }
}
