<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Berita;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Pastikan User Admin ada
        User::updateOrCreate(
            ['email' => 'admin@dinkes.go.id'],
            [
                'name' => 'Admin Dinkes',
                'password' => bcrypt('password123'),
            ]
        );

        // Seeding data Berita contoh
        $beritaData = [
            [
                'title' => 'Dinas Kesehatan Cianjur Gelar Sosialisasi Germas Sehat',
                'category' => 'Kegiatan',
                'content' => 'Dinas Kesehatan Kabupaten Cianjur menggelar sosialisasi Gerakan Masyarakat Hidup Sehat (Germas) di tingkat kecamatan. Kegiatan ini bertujuan untuk meningkatkan kesadaran masyarakat akan pentingnya pola hidup bersih dan sehat (PHBS) sehari-hari, serta konsumsi makanan bergizi seimbang untuk mencegah berbagai penyakit tidak menular.',
                'image' => null,
                'views' => 128,
                'status' => 'published',
            ],
            [
                'title' => 'Langkah Nyata Dinkes Cianjur Menurunkan Angka Stunting',
                'category' => 'Kesehatan',
                'content' => 'Dalam upaya mempercepat penurunan angka stunting di Kabupaten Cianjur, Dinas Kesehatan berkolaborasi dengan berbagai instansi terkait menyelenggarakan program pemantauan gizi buruk secara intensif. Program ini melibatkan puskesmas setempat untuk memberikan makanan tambahan dan edukasi gizi bagi ibu hamil dan balita.',
                'image' => null,
                'views' => 245,
                'status' => 'published',
            ],
            [
                'title' => 'Imunisasi Polio Serentak di 47 Puskesmas Cianjur',
                'category' => 'Pengumuman',
                'content' => 'Diberitahukan kepada seluruh masyarakat Kabupaten Cianjur bahwa Dinas Kesehatan menyelenggarakan Pekan Imunisasi Nasional (PIN) Polio serentak di 47 Puskesmas dan Posyandu terdekat. Semua balita usia 0-7 tahun diharapkan hadir untuk mendapatkan tetes manis polio secara gratis guna mencegah kelumpuhan anak.',
                'image' => null,
                'views' => 95,
                'status' => 'published',
            ],
            [
                'title' => 'Penyuluhan Bahaya Demam Berdarah (DBD) di Musim Hujan',
                'category' => 'Kesehatan',
                'content' => 'Mengantisipasi peningkatan kasus demam berdarah dengue (DBD) di musim hujan, tim penyuluhan Dinas Kesehatan Cianjur mengadakan sosialisasi gerakan 3M Plus (Menguras, Menutup, Mendaur Ulang). Masyarakat dihimbau untuk selalu waspada dan aktif membersihkan genangan air di sekitar lingkungan tempat tinggal.',
                'image' => null,
                'views' => 189,
                'status' => 'published',
            ],
            [
                'title' => 'Dinkes Raih Penghargaan Pelayanan Publik Terbaik 2026',
                'category' => 'Kegiatan',
                'content' => 'Dinas Kesehatan Kabupaten Cianjur berhasil mendapatkan penghargaan bergengsi atas dedikasi dan kualitas pelayanan publik bidang kesehatan yang inovatif dan responsif. Penghargaan ini diserahkan langsung oleh Bupati Cianjur sebagai bentuk apresiasi kinerja aparatur kesehatan di daerah.',
                'image' => null,
                'views' => 312,
                'status' => 'published',
            ]
        ];

        foreach ($beritaData as $data) {
            $data['slug'] = \Illuminate\Support\Str::slug($data['title']);
            Berita::updateOrCreate(
                ['title' => $data['title']],
                $data
            );
        }
    }
}
