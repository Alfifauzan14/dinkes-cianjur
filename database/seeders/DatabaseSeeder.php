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

        // Seeding data Stunting Records with details
        $stuntingData = [
            [
                'year' => 2018, 
                'rate' => 4.2, 
                'total_balita' => 124500, 
                'balita_stunting' => 5229, 
                'wilayah_terendah' => 'Kec. Pacet (1.2%)', 
                'wilayah_tertinggi' => 'Kec. Cidaun (7.8%)', 
                'catatan' => 'Fokus awal pada pembangunan sarana air bersih di kecamatan dengan sanitasi buruk.',
                'is_highlighted' => false
            ],
            [
                'year' => 2019, 
                'rate' => 16.2, 
                'total_balita' => 128400, 
                'balita_stunting' => 20800, 
                'wilayah_terendah' => 'Kec. Cipanas (5.4%)', 
                'wilayah_tertinggi' => 'Kec. Sindangbarang (24.1%)', 
                'catatan' => 'Peningkatan angka tercatat karena perbaikan metodologi pendataan digital di posyandu.',
                'is_highlighted' => false
            ],
            [
                'year' => 2020, 
                'rate' => 4.8, 
                'total_balita' => 131200, 
                'balita_stunting' => 6297, 
                'wilayah_terendah' => 'Kec. Cianjur Kota (1.8%)', 
                'wilayah_tertinggi' => 'Kec. Pagelaran (9.2%)', 
                'catatan' => 'Dampak program bantuan sosial pangan selama pandemi COVID-19 membantu gizi keluarga.',
                'is_highlighted' => false
            ],
            [
                'year' => 2021, 
                'rate' => 18.2, 
                'total_balita' => 135000, 
                'balita_stunting' => 24570, 
                'wilayah_terendah' => 'Kec. Karangtengah (8.2%)', 
                'wilayah_tertinggi' => 'Kec. Naringgul (29.5%)', 
                'catatan' => 'Hasil survei SSGI nasional menunjukkan angka prevalensi yang lebih tinggi dibanding e-PPGBM.',
                'is_highlighted' => false
            ],
            [
                'year' => 2022, 
                'rate' => 9.8, 
                'total_balita' => 138600, 
                'balita_stunting' => 13582, 
                'wilayah_terendah' => 'Kec. Bojongpicung (4.1%)', 
                'wilayah_tertinggi' => 'Kec. Kadupandak (18.6%)', 
                'catatan' => 'Peluncuran program Orang Tua Asuh Anak Stunting terbukti menurunkan angka kasus secara signifikan.',
                'is_highlighted' => false
            ],
            [
                'year' => 2023, 
                'rate' => 14.7, 
                'total_balita' => 141000, 
                'balita_stunting' => 20727, 
                'wilayah_terendah' => 'Kec. Mande (6.2%)', 
                'wilayah_tertinggi' => 'Kec. Sukaresmi (21.3%)', 
                'catatan' => 'Intervensi gizi spesifik difokuskan pada 10 desa lokus stunting prioritas pertama.',
                'is_highlighted' => false
            ],
            [
                'year' => 2024, 
                'rate' => 18.2, 
                'total_balita' => 143200, 
                'balita_stunting' => 26062, 
                'wilayah_terendah' => 'Kec. Cibeber (9.1%)', 
                'wilayah_tertinggi' => 'Kec. Agrabinta (28.4%)', 
                'catatan' => 'Survei ulang dilakukan pasca gempa bumi untuk mendeteksi kerentanan pangan balita di pengungsian.',
                'is_highlighted' => false
            ],
            [
                'year' => 2025, 
                'rate' => 14.7, 
                'total_balita' => 145000, 
                'balita_stunting' => 21315, 
                'wilayah_terendah' => 'Kec. Ciranjang (5.8%)', 
                'wilayah_tertinggi' => 'Kec. Leles (22.5%)', 
                'catatan' => 'Implementasi program beras fortifikasi (Nutri Rice) untuk ibu hamil di seluruh wilayah rawan.',
                'is_highlighted' => false
            ],
            [
                'year' => 2026, 
                'rate' => 9.8, 
                'total_balita' => 147500, 
                'balita_stunting' => 14455, 
                'wilayah_terendah' => 'Kec. Haurwangi (3.2%)', 
                'wilayah_tertinggi' => 'Kec. Campakamulya (15.7%)', 
                'catatan' => 'Penurunan signifikan ditopang oleh integrasi satu data kesehatan e-PPGBM dan kolaborasi lintas OPD.',
                'is_highlighted' => true
            ],
        ];

        foreach ($stuntingData as $record) {
            \App\Models\StuntingRecord::updateOrCreate(
                ['year' => $record['year']],
                [
                    'rate' => $record['rate'],
                    'total_balita' => $record['total_balita'],
                    'balita_stunting' => $record['balita_stunting'],
                    'wilayah_terendah' => $record['wilayah_terendah'],
                    'wilayah_tertinggi' => $record['wilayah_tertinggi'],
                    'catatan' => $record['catatan'],
                    'is_highlighted' => $record['is_highlighted']
                ]
            );
        }

        // Seeding data Statistik Settings (Single Row)
        \App\Models\StatistikSetting::updateOrCreate(
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
                ]
            ]
        );

        // Create mock directories & documents in public disk
        \Illuminate\Support\Facades\Storage::disk('public')->makeDirectory('laporan');
        \Illuminate\Support\Facades\Storage::disk('public')->makeDirectory('regulasi/documents');
        \Illuminate\Support\Facades\Storage::disk('public')->put('laporan/dummy_laporan.pdf', '%PDF-1.4 Mock Laporan PDF Content');
        \Illuminate\Support\Facades\Storage::disk('public')->put('regulasi/documents/dummy_regulasi.pdf', '%PDF-1.4 Mock Regulasi PDF Content');

        // Seeding Laporan
        $laporans = [
            [
                'title' => 'Laporan Akuntabilitas Kinerja Instansi Pemerintah (LKjIP) Dinas Kesehatan 2025',
                'category' => 'Laporan Kinerja',
                'file_path' => 'laporan/dummy_laporan.pdf',
                'file_size' => '2.4 MB',
                'release_date' => '2025-12-15',
            ],
            [
                'title' => 'Laporan Keuangan Prognosis Triwulan IV TA 2025',
                'category' => 'Laporan Keuangan',
                'file_path' => 'laporan/dummy_laporan.pdf',
                'file_size' => '1.8 MB',
                'release_date' => '2025-11-20',
            ],
            [
                'title' => 'Rencana Kerja (Renja) Dinas Kesehatan Kabupaten Cianjur 2026',
                'category' => 'Laporan Kinerja',
                'file_path' => 'laporan/dummy_laporan.pdf',
                'file_size' => '3.1 MB',
                'release_date' => '2026-01-10',
            ],
            [
                'title' => 'Laporan Layanan Informasi Publik PPID Pembantu Dinas Kesehatan 2025',
                'category' => 'Informasi Publik',
                'file_path' => 'laporan/dummy_laporan.pdf',
                'file_size' => '1.2 MB',
                'release_date' => '2026-01-15',
            ],
            [
                'title' => 'Dokumen Paket Pengadaan Obat & Perbekalan Medis LPSE 2026',
                'category' => 'Informasi Publik',
                'file_path' => 'laporan/dummy_laporan.pdf',
                'file_size' => '950 KB',
                'release_date' => '2026-02-01',
            ],
        ];

        foreach ($laporans as $lap) {
            \App\Models\Laporan::updateOrCreate(
                ['title' => $lap['title']],
                $lap
            );
        }

        // Seeding Regulasi
        $regulasis = [
            [
                'title' => 'Perbup No. 42 Tahun 2024',
                'category' => 'PERATURAN BUPATI',
                'topic' => 'PERBUP STUNTING',
                'description' => 'Percepatan Penurunan Stunting Terpadu dan Tata Kelola Tim Pendamping Keluarga (TPK) Kabupaten Cianjur.',
                'year' => 2024,
                'cover_path' => null,
                'file_path' => 'regulasi/documents/dummy_regulasi.pdf',
                'file_size' => '2.4 MB',
                'status' => 'Berlaku',
            ],
            [
                'title' => 'Perbup No. 38 Tahun 2024',
                'category' => 'PERATURAN BUPATI',
                'topic' => 'KIA',
                'description' => 'Pedoman Pelaksanaan Program Kesehatan Ibu dan Anak dalam Upaya Peningkatan Status Gizi Masyarakat.',
                'year' => 2024,
                'cover_path' => null,
                'file_path' => 'regulasi/documents/dummy_regulasi.pdf',
                'file_size' => '1.9 MB',
                'status' => 'Berlaku',
            ],
            [
                'title' => 'Perbup No. 35 Tahun 2024',
                'category' => 'PERATURAN BUPATI',
                'topic' => 'GERMAS',
                'description' => 'Tata Cara Pelaksanaan Gerakan Masyarakat Hidup Sehat (GERMAS) di Kabupaten Cianjur.',
                'year' => 2024,
                'cover_path' => null,
                'file_path' => 'regulasi/documents/dummy_regulasi.pdf',
                'file_size' => '2.1 MB',
                'status' => 'Berlaku',
            ],
            [
                'title' => 'Perbup No. 29 Tahun 2023',
                'category' => 'PERATURAN BUPATI',
                'topic' => 'FASKES',
                'description' => 'Penyelenggaraan Pelayanan Kesehatan Dasar pada Fasilitas Pelayanan Kesehatan Milik Pemerintah Daerah.',
                'year' => 2023,
                'cover_path' => null,
                'file_path' => 'regulasi/documents/dummy_regulasi.pdf',
                'file_size' => '3.2 MB',
                'status' => 'Berlaku',
            ],
            [
                'title' => 'Perbup No. 18 Tahun 2022',
                'category' => 'PERATURAN BUPATI',
                'topic' => 'KIA',
                'description' => 'Strategi Daerah Peningkatan Cakupan Imunisasi dan Kesehatan Anak di Kabupaten Cianjur.',
                'year' => 2022,
                'cover_path' => null,
                'file_path' => 'regulasi/documents/dummy_regulasi.pdf',
                'file_size' => '1.7 MB',
                'status' => 'Berlaku',
            ],
        ];

        foreach ($regulasis as $reg) {
            \App\Models\Regulasi::updateOrCreate(
                ['title' => $reg['title']],
                $reg
            );
        }
    }
}
