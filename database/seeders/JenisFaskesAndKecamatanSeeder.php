<?php

namespace Database\Seeders;

use App\Models\JenisFaskes;
use App\Models\Kecamatan;
use Illuminate\Database\Seeder;

class JenisFaskesAndKecamatanSeeder extends Seeder
{
    public function run(): void
    {
        $types = ['Rumah Sakit', 'Puskesmas'];
        foreach ($types as $type) {
            JenisFaskes::updateOrCreate(['name' => $type]);
        }

        $kecamatans = [
            'Agrabinta',
            'Campaka',
            'Campakamulya',
            'Cibeber',
            'Cibinong',
            'Cidaun',
            'Cijati',
            'Cikalongkulon',
            'Cilaku',
            'Ciranjang',
            'Cugenang',
            'Gekbrong',
            'Haurwangi',
            'Kadupandak',
            'Karangtengah',
            'Leles',
            'Mande',
            'Naringgul',
            'Pacet',
            'Pagelaran',
            'Pasirkuda',
            'Sindangbarang',
            'Sukanagara',
            'Sukaluyu',
            'Sukaresmi',
            'Takokak',
            'Tanggeung',
            'Warungkondang',
        ];

        foreach ($kecamatans as $kec) {
            Kecamatan::updateOrCreate(['name' => $kec]);
        }
    }
}
