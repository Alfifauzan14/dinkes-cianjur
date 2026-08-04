<?php

namespace Database\Seeders;

use App\Models\FasilitasKesehatan;
use App\Models\Wilayah;
use Illuminate\Database\Seeder;

/**
 * Seeder tambahan (bukan pengganti FasilitasKesehatanSeeder).
 * Berisi RS swasta yang belum masuk di seeder utama.
 *
 * Cilaku & Naringgul TIDAK dimasukkan di sini juga — hasil pencarian
 * untuk 2 kecamatan itu tetap tidak akurat (Google Places mengembalikan
 * data dari kecamatan lain / kategori yang salah). Silakan cek manual
 * di Google Maps lalu tambahkan sendiri ke database.
 *
 * Jalankan dengan: php artisan db:seed --class=FasilitasKesehatanTambahanSeeder
 * (setelah FasilitasKesehatanSeeder & WilayahSeeder sudah dijalankan)
 */
class FasilitasKesehatanTambahanSeeder extends Seeder
{
    public function run(): void
    {
        $wilayah = Wilayah::pluck('id', 'nama');

        $data = [
            [
                'nama' => 'RS Dr. Hafiz (RSDH) Cianjur',
                'jenis' => 'rumah_sakit',
                'layanan' => 'rawat_inap',
                'wilayah' => 'Karangtengah',
                'alamat' => 'Jl. Pramuka No.15, Bojong, Kec. Karangtengah, Kabupaten Cianjur, Jawa Barat 43281',
                'telepon' => '(0263) 2910000',
                'jam_operasional' => 'Senin - Minggu, 24 Jam',
                'latitude' => -6.7980975,
                'longitude' => 107.1753116,
                'akreditasi' => null,
            ],
            [
                'nama' => 'RS Edelweiss Bentang Salapan',
                'jenis' => 'rumah_sakit',
                'layanan' => 'rawat_inap',
                'wilayah' => 'Karangtengah',
                'alamat' => 'Jl. Nasional III No.253-254, Bojong, Kec. Karangtengah, Kabupaten Cianjur, Jawa Barat 43281',
                'telepon' => '(0263) 5600999',
                'jam_operasional' => 'Senin - Minggu, 24 Jam',
                'latitude' => -6.8031379,
                'longitude' => 107.1715779,
                'akreditasi' => null,
            ],
            [
                'nama' => 'RS Hermina CMS Cianjur',
                'jenis' => 'rumah_sakit',
                'layanan' => 'rawat_inap',
                'wilayah' => 'Cianjur',
                'alamat' => 'Nagrak, Kec. Cianjur, Kabupaten Cianjur, Jawa Barat 43215',
                'telepon' => null,
                'jam_operasional' => 'Senin - Minggu, 24 Jam',
                'latitude' => -6.834112,
                'longitude' => 107.1232456,
                'akreditasi' => null,
            ],
        ];

        foreach ($data as $item) {
            FasilitasKesehatan::updateOrCreate(
                ['nama' => $item['nama']],
                [
                    'jenis' => $item['jenis'],
                    'layanan' => $item['layanan'],
                    'wilayah_id' => $wilayah[$item['wilayah']],
                    'alamat' => $item['alamat'],
                    'telepon' => $item['telepon'],
                    'jam_operasional' => $item['jam_operasional'],
                    'latitude' => $item['latitude'],
                    'longitude' => $item['longitude'],
                    'akreditasi' => $item['akreditasi'],
                ]
            );
        }
    }
}
