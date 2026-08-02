<?php

namespace Database\Seeders;

use App\Models\Agenda;
use App\Models\Berita;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

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
            ],
            [
                'title' => 'Dinas Kesehatan Cianjur Berhasil Luncurkan Aplikasi Satu Data Kesehatan',
                'category' => 'Pengumuman',
                'content' => 'Sebagai wujud transparansi dan penyediaan informasi yang akurat bagi masyarakat, Dinas Kesehatan Kabupaten Cianjur resmi meluncurkan portal Satu Data Kesehatan. Portal ini mengintegrasikan seluruh indikator pelayanan puskesmas, sebaran rumah sakit rujukan, rasio tenaga medis, serta profil kesehatan tahunan yang dapat diakses dengan mudah secara daring.',
                'image' => null,
                'views' => 156,
                'status' => 'published',
            ],
        ];

        foreach ($beritaData as $data) {
            $data['slug'] = Str::slug($data['title']);
            Berita::updateOrCreate(
                ['title' => $data['title']],
                $data
            );
        }

        // Seeding data Agenda contoh
        $agendaData = [
            [
                'title' => 'Apel Pagi & Evaluasi Kinerja Mingguan',
                'date' => '2026-07-08',
                'time_start' => '07:30',
                'time_end' => '09:00',
                'location' => 'Kantor Dinkes',
                'description' => 'Apel rutin hari Senin beserta evaluasi kinerja masing-masing bidang pelayanan.',
                'status' => 'published',
            ],
            [
                'title' => 'Rapat Koordinasi Program Kesehatan',
                'date' => '2026-07-08',
                'time_start' => '09:00',
                'time_end' => '11:00',
                'location' => 'Ruang Rapat Dinkes',
                'description' => 'Membahas program pencegahan stunting and imunisasi anak.',
                'status' => 'published',
            ],
            [
                'title' => 'Sosialisasi Kesehatan Masyarakat',
                'date' => '2026-07-08',
                'time_start' => '11:00',
                'time_end' => '12:00',
                'location' => 'Aula Dinkes',
                'description' => 'Sosialisasi hidup bersih sehat di era digital.',
                'status' => 'published',
            ],
            [
                'title' => 'Pemeriksaan Kesehatan Gratis Lansia',
                'date' => '2026-07-10',
                'time_start' => '08:00',
                'time_end' => '12:00',
                'location' => 'Posyandu Mawar',
                'description' => 'Layanan pemeriksaan kesehatan, tekanan darah, dan gula darah gratis bagi lansia.',
                'status' => 'published',
            ],
            [
                'title' => 'Bimbingan Teknis Tenaga Medis Puskesmas',
                'date' => '2026-08-02',
                'time_start' => '09:00',
                'time_end' => '15:00',
                'location' => 'Hotel Grand Cianjur',
                'description' => 'Peningkatan kapasitas pelayanan primer di puskesmas seluruh Kabupaten Cianjur.',
                'status' => 'published',
            ],
        ];

        foreach ($agendaData as $data) {
            Agenda::updateOrCreate(
                ['title' => $data['title'], 'date' => $data['date']],
                $data
            );
        }

        // Seeding data Galeri contoh
        $galeriData = [
            [
                'title' => 'Penguatan Sinergi Dinas Kesehatan Cianjur Bersama Klinik Utama Rotinsulu',
                'image' => 'dumy1.png',
                'category' => 'PROGRAM',
            ],
            [
                'title' => 'Layanan Siaga Darurat PSC 119 Terintegrasi',
                'image' => 'dumy1.png',
                'category' => 'PROGRAM',
            ],
            [
                'title' => 'Peringatan Hari Keluarga Nasional Tingkat Kabupaten',
                'image' => 'dumy2.png',
                'category' => 'PROGRAM',
            ],
            [
                'title' => 'Pendaftaran Lomba Inovasi Daerah Sektor Kesehatan',
                'image' => 'dumy2.png',
                'category' => 'PROGRAM',
            ],
            [
                'title' => 'Pencapaian Universal Health Coverage (UHC) Kabupaten Cianjur',
                'image' => 'dumy2.png',
                'category' => 'PROGRAM',
            ],
            [
                'title' => 'Sosialisasi Penurunan Stunting Terpadu',
                'image' => 'dumy1.png',
                'category' => 'KEGIATAN',
            ],
        ];

        foreach ($galeriData as $data) {
            \App\Models\Galeri::updateOrCreate(
                ['title' => $data['title']],
                $data
            );
        }

        // Seeding data Profil & Sambutan Pimpinan (Single Row)
        \App\Models\Profile::updateOrCreate(
            ['id' => 1],
            [
                'kepala_dinas_name' => 'Dr. I Made Setiawan',
                'kepala_dinas_role' => 'Kepala Dinas Kesehatan Kabupaten Cianjur',
                'sambutan_title' => 'Selamat Datang di Portal Resmi Dinkes Cianjur',
                'sambutan_quote' => 'Kesehatan masyarakat adalah fondasi utama pembangunan daerah. Kami berkomitmen memberikan keterbukaan data dan kemudahan akses medis bagi seluruh warga Cianjur.',
                'sambutan_desc_1' => 'Melalui portal ini, kami berupaya mendekatkan pelayanan kesehatan kepada masyarakat secara digital. Mulai dari pendaftaran pasien, pencarian klinik, hingga publikasi status sebaran gizi dan stunting untuk mewujudkan Cianjur sehat.',
                'sambutan_desc_2' => 'Mari kita bersama-sama menerapkan Pola Hidup Bersih dan Sehat (PHBS) demi masa depan keluarga kita yang lebih baik.',
                'kepala_dinas_image' => 'Group 83.png',
                'sejarah_title' => 'Perjalanan Dinas Kesehatan Kabupaten Cianjur',
                'sejarah_text_1' => 'Dinas Kesehatan Kabupaten Cianjur adalah unsur pelaksana otonomi daerah yang menjadi garda terdepan dalam meningkatkan derajat kesehatan masyarakat di wilayah seluas ±3.501,48 km² dengan 2,3 juta jiwa penduduk.',
                'sejarah_text_2' => 'Mengelola 47 Puskesmas di 32 kecamatan beserta Labkesda, kami berkomitmen penuh menyelenggarakan pelayanan kesehatan yang profesional, merata, dan terintegrasi demi mewujudkan masyarakat Cianjur yang sehat dan mandiri.',
                'sejarah_image' => null,
                'visi_title' => 'Mewujudkan Masyarakat Kabupaten Cianjur yang Sehat, Mandiri, Berkeadilan, dan Berdaya Saing.',
                'visi_desc' => 'Dinas Kesehatan Kabupaten Cianjur berkomitmen penuh mendorong transformasi pelayanan kesehatan agar seluruh warga memiliki akses yang setara, cepat, dan terjangkau terhadap layanan medis berkualitas.',
                'stat_1_text' => '47 Puskesmas Rujukan',
                'stat_2_text' => '32 Kecamatan Terjangkau',
                
                'misi' => [
                    [
                        'title' => '1. Pemerataan Pelayanan',
                        'desc' => 'Menjamin ketersediaan layanan kesehatan yang merata, cepat, dan terjangkau bagi seluruh masyarakat.'
                    ],
                    [
                        'title' => '2. Tata Kelola Adil',
                        'desc' => 'Membangun manajemen pelayanan kesehatan yang efisien, transparan, dan berbasis teknologi informasi.'
                    ],
                    [
                        'title' => '3. SDM Profesional',
                        'desc' => 'Meningkatkan kompetensi, kuantitas, dan penyebaran tenaga kesehatan yang berkualitas.'
                    ],
                    [
                        'title' => '4. Kemandirian Masyarakat',
                        'desc' => 'Mendorong promosi kesehatan agar masyarakat mampu hidup bersih dan sehat secara mandiri.'
                    ],
                    [
                        'title' => '5. Mutu Pelayanan',
                        'desc' => 'Meningkatkan mutu pelayanan yang berorientasi pada kepuasan pasien di seluruh fasilitas.'
                    ],
                    [
                        'title' => '6. Ketahanan Kesehatan',
                        'desc' => 'Memperkuat sistem kesiapsiagaan dalam penanggulangan penyakit menular secara berkelanjutan.'
                    ],
                ]
            ]
        );
    }
}
