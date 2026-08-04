<?php

namespace Database\Seeders;

use App\Models\Agenda;
use App\Models\Berita;
use App\Models\Galeri;
use App\Models\Laporan;
use App\Models\LayananTerpadu;
use App\Models\Profile;
use App\Models\ProgramKesehatan;
use App\Models\Regulasi;
use App\Models\StatistikSetting;
use App\Models\StuntingRecord;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
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
            Galeri::updateOrCreate(
                ['title' => $data['title']],
                $data
            );
        }

        // Seeding data Profil & Sambutan Pimpinan (Single Row)
        Profile::updateOrCreate(
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
                        'desc' => 'Menjamin ketersediaan layanan kesehatan yang merata, cepat, dan terjangkau bagi seluruh masyarakat.',
                    ],
                    [
                        'title' => '2. Tata Kelola Adil',
                        'desc' => 'Membangun manajemen pelayanan kesehatan yang efisien, transparan, dan berbasis teknologi informasi.',
                    ],
                    [
                        'title' => '3. SDM Profesional',
                        'desc' => 'Meningkatkan kompetensi, kuantitas, dan penyebaran tenaga kesehatan yang berkualitas.',
                    ],
                    [
                        'title' => '4. Kemandirian Masyarakat',
                        'desc' => 'Mendorong promosi kesehatan agar masyarakat mampu hidup bersih dan sehat secara mandiri.',
                    ],
                    [
                        'title' => '5. Mutu Pelayanan',
                        'desc' => 'Meningkatkan mutu pelayanan yang berorientasi pada kepuasan pasien di seluruh fasilitas.',
                    ],
                    [
                        'title' => '6. Ketahanan Kesehatan',
                        'desc' => 'Memperkuat sistem kesiapsiagaan dalam penanggulangan penyakit menular secara berkelanjutan.',
                    ],
                ],
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
                'is_highlighted' => false,
            ],
            [
                'year' => 2019,
                'rate' => 16.2,
                'total_balita' => 128400,
                'balita_stunting' => 20800,
                'wilayah_terendah' => 'Kec. Cipanas (5.4%)',
                'wilayah_tertinggi' => 'Kec. Sindangbarang (24.1%)',
                'catatan' => 'Peningkatan angka tercatat karena perbaikan metodologi pendataan digital di posyandu.',
                'is_highlighted' => false,
            ],
            [
                'year' => 2020,
                'rate' => 4.8,
                'total_balita' => 131200,
                'balita_stunting' => 6297,
                'wilayah_terendah' => 'Kec. Cianjur Kota (1.8%)',
                'wilayah_tertinggi' => 'Kec. Pagelaran (9.2%)',
                'catatan' => 'Dampak program bantuan sosial pangan selama pandemi COVID-19 membantu gizi keluarga.',
                'is_highlighted' => false,
            ],
            [
                'year' => 2021,
                'rate' => 18.2,
                'total_balita' => 135000,
                'balita_stunting' => 24570,
                'wilayah_terendah' => 'Kec. Karangtengah (8.2%)',
                'wilayah_tertinggi' => 'Kec. Naringgul (29.5%)',
                'catatan' => 'Hasil survei SSGI nasional menunjukkan angka prevalensi yang lebih tinggi dibanding e-PPGBM.',
                'is_highlighted' => false,
            ],
            [
                'year' => 2022,
                'rate' => 9.8,
                'total_balita' => 138600,
                'balita_stunting' => 13582,
                'wilayah_terendah' => 'Kec. Bojongpicung (4.1%)',
                'wilayah_tertinggi' => 'Kec. Kadupandak (18.6%)',
                'catatan' => 'Peluncuran program Orang Tua Asuh Anak Stunting terbukti menurunkan angka kasus secara signifikan.',
                'is_highlighted' => false,
            ],
            [
                'year' => 2023,
                'rate' => 14.7,
                'total_balita' => 141000,
                'balita_stunting' => 20727,
                'wilayah_terendah' => 'Kec. Mande (6.2%)',
                'wilayah_tertinggi' => 'Kec. Sukaresmi (21.3%)',
                'catatan' => 'Intervensi gizi spesifik difokuskan pada 10 desa lokus stunting prioritas pertama.',
                'is_highlighted' => false,
            ],
            [
                'year' => 2024,
                'rate' => 18.2,
                'total_balita' => 143200,
                'balita_stunting' => 26062,
                'wilayah_terendah' => 'Kec. Cibeber (9.1%)',
                'wilayah_tertinggi' => 'Kec. Agrabinta (28.4%)',
                'catatan' => 'Survei ulang dilakukan pasca gempa bumi untuk mendeteksi kerentanan pangan balita di pengungsian.',
                'is_highlighted' => false,
            ],
            [
                'year' => 2025,
                'rate' => 14.7,
                'total_balita' => 145000,
                'balita_stunting' => 21315,
                'wilayah_terendah' => 'Kec. Ciranjang (5.8%)',
                'wilayah_tertinggi' => 'Kec. Leles (22.5%)',
                'catatan' => 'Implementasi program beras fortifikasi (Nutri Rice) untuk ibu hamil di seluruh wilayah rawan.',
                'is_highlighted' => false,
            ],
            [
                'year' => 2026,
                'rate' => 9.8,
                'total_balita' => 147500,
                'balita_stunting' => 14455,
                'wilayah_terendah' => 'Kec. Haurwangi (3.2%)',
                'wilayah_tertinggi' => 'Kec. Campakamulya (15.7%)',
                'catatan' => 'Penurunan signifikan ditopang oleh integrasi satu data kesehatan e-PPGBM dan kolaborasi lintas OPD.',
                'is_highlighted' => true,
            ],
        ];

        foreach ($stuntingData as $record) {
            StuntingRecord::updateOrCreate(
                ['year' => $record['year']],
                [
                    'rate' => $record['rate'],
                    'total_balita' => $record['total_balita'],
                    'balita_stunting' => $record['balita_stunting'],
                    'wilayah_terendah' => $record['wilayah_terendah'],
                    'wilayah_tertinggi' => $record['wilayah_tertinggi'],
                    'catatan' => $record['catatan'],
                    'is_highlighted' => $record['is_highlighted'],
                ]
            );
        }

        // Seeding data Statistik Settings (Single Row)
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

        // Create mock directories & documents in public disk
        Storage::disk('public')->makeDirectory('laporan');
        Storage::disk('public')->makeDirectory('regulasi/documents');
        Storage::disk('public')->put('laporan/dummy_laporan.pdf', '%PDF-1.4 Mock Laporan PDF Content');
        Storage::disk('public')->put('regulasi/documents/dummy_regulasi.pdf', '%PDF-1.4 Mock Regulasi PDF Content');

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
            Laporan::updateOrCreate(
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
            Regulasi::updateOrCreate(
                ['title' => $reg['title']],
                $reg
            );
        }

        // Seeding Layanan Terpadu
        $layananTerpadus = [
            // Warga
            ['name' => 'Pendaftaran Peserta Penduduk PBPU dan BP Pemda Program JKN', 'type' => 'Warga', 'icon' => 'users', 'link' => null],
            ['name' => 'Penyelenggaraan Jaminan Kesehatan Di Luar Skema JKN', 'type' => 'Warga', 'icon' => 'smile', 'link' => null],
            ['name' => 'Pengelolaan Pengaduan Masyarakat', 'type' => 'Warga', 'icon' => 'chat', 'link' => null],
            ['name' => 'Pengelolaan Informasi Publik', 'type' => 'Warga', 'icon' => 'chat', 'link' => null],

            // Faskes
            ['name' => 'Rekomendasi Penutupan Klinik', 'type' => 'Faskes', 'icon' => 'desktop', 'link' => null],
            ['name' => 'Rekomendasi Izin Operasional Klinik', 'type' => 'Faskes', 'icon' => 'desktop', 'link' => null],
            ['name' => 'Rekomendasi Perizinan Apotek', 'type' => 'Faskes', 'icon' => 'bag', 'link' => null],
            ['name' => 'Rekomendasi Penutupan Apotek', 'type' => 'Faskes', 'icon' => 'desktop', 'link' => null],
            ['name' => 'Rekomendasi Penutupan Toko Obat', 'type' => 'Faskes', 'icon' => 'desktop', 'link' => null],
            ['name' => 'Rekomendasi Perizinan Toko Obat', 'type' => 'Faskes', 'icon' => 'bag', 'link' => null],
            ['name' => 'Rekomendasi Penutupan Instalasi Farmasi Klinik', 'type' => 'Faskes', 'icon' => 'desktop', 'link' => null],
            ['name' => 'Konsultasi Perizinan Berusaha Optikal', 'type' => 'Faskes', 'icon' => 'globe', 'link' => null],
            ['name' => 'Konsultasi Perizinan Berusaha Toko Alat Kesehatan', 'type' => 'Faskes', 'icon' => 'globe', 'link' => null],
            ['name' => 'Konsultasi Perizinan Berusaha Perusahaan Rumah Tangga Alkes PKRT Tertentu', 'type' => 'Faskes', 'icon' => 'globe', 'link' => null],
            ['name' => 'Konsultasi Sertifikat Pemenuhan Komitmen Produksi Pangan Olahan Industri Rumah Tangga SPP-IRT', 'type' => 'Faskes', 'icon' => 'file', 'link' => null],
            ['name' => 'Penerbitan Persetujuan Teknis Izin Aktivitas Rumah Sakit', 'type' => 'Faskes', 'icon' => 'desktop', 'link' => null],
            ['name' => 'Sertifikat Laik Sehat Akomodasi', 'type' => 'Faskes', 'icon' => 'file', 'link' => null],
            ['name' => 'Notifikasi Pemenuhan Komitmen Ijin Penyelenggaraan Pengendalian Vektor Dan Binatang Pembawa Penyakit', 'type' => 'Faskes', 'icon' => 'chat', 'link' => null],
            ['name' => 'Rekomendasi Sertifikat Laik Higiene Sanitasi Jasaboga/Catering/Rumah Makan/Restoran, Depot Air Minum', 'type' => 'Faskes', 'icon' => 'file', 'link' => null],
            ['name' => 'Penerbitan Izin Penelitian/Magang/PKL', 'type' => 'Faskes', 'icon' => 'desktop', 'link' => null],

            // Nakes
            ['name' => 'Penerbitan Sertifikat Penyuluhan Keamanan Pangan PKP', 'type' => 'Nakes', 'icon' => 'file', 'link' => null],
            ['name' => 'Rekomendasi Perizinan Tenaga Medis', 'type' => 'Nakes', 'icon' => 'users', 'link' => null],
            ['name' => 'Rekomendasi Perizinan Tenaga Kesehatan', 'type' => 'Nakes', 'icon' => 'users', 'link' => null],
            ['name' => 'Rekomendasi Perizinan Surat Terdaftar Penyehat Tradisional', 'type' => 'Nakes', 'icon' => 'file', 'link' => null],
        ];

        foreach ($layananTerpadus as $layanan) {
            LayananTerpadu::updateOrCreate(
                ['name' => $layanan['name']],
                $layanan
            );
        }

        // Seeding Program Kesehatan (Stunting & KIA)
        $programs = [
            [
                'title' => 'Cianjur Bebas Stunting',
                'slug' => 'cianjur-bebas-stunting',
                'subtitle' => 'Program komprehensif untuk mencegah dan menurunkan angka stunting di Kabupaten Cianjur melalui intervensi gizi dan edukasi.',
                'stat_1_num' => '12.5%',
                'stat_1_label' => 'Prevalensi Stunting',
                'stat_2_num' => '3,200',
                'stat_2_label' => 'Balita Terpantau',
                'stat_3_num' => '2,800',
                'stat_3_label' => 'Keluarga Penerima Manfaat',
                'content' => '<h3 class="st-content-title">Apa itu Stunting?</h3>
<p class="st-content-text">Stunting adalah kondisi gagal tumbuh pada anak balita (bayi di bawah lima tahun) akibat kekurangan gizi kronis sehingga anak terlalu pendek untuk usianya. Kekurangan gizi terjadi sejak bayi dalam kandungan hingga awal kehidupan anak (1000 Hari Pertama Kehidupan).</p>
<h3 class="st-content-title">Penyebab Stunting</h3>
<ul class="st-content-list">
    <li>Kurangnya asupan gizi pada ibu selama kehamilan.</li>
    <li>Kebutuhan gizi anak tidak tercukupi.</li>
    <li>Kurangnya pengetahuan ibu mengenai kesehatan dan gizi.</li>
    <li>Terbatasnya layanan kesehatan termasuk layanan kehamilan dan nifas.</li>
    <li>Kurangnya akses makanan bergizi dan air bersih.</li>
</ul>
<h3 class="st-content-title">Dampak Stunting</h3>
<p class="st-content-text">Stunting tidak hanya menyebabkan tubuh anak pendek, tetapi juga menghambat perkembangan otak, menurunkan kemampuan belajar, dan meningkatkan risiko penyakit kronis di masa dewasa.</p>',
                'intervensi' => [
                    ['title' => 'Pemberian Makanan Tambahan (PMT) untuk Balita', 'description' => 'Menyediakan makanan bergizi tinggi untuk balita stunting dan gizi buruk guna memenuhi kebutuhan nutrisi harian mereka.'],
                    ['title' => 'Edukasi Gizi dan Pola Asuh untuk Orang Tua', 'description' => 'Memberikan pendampingan dan edukasi kepada orang tua tentang pola asuh yang baik, gizi seimbang, dan stimulasi tumbuh kembang anak.'],
                    ['title' => 'Pemantauan Tumbuh Kembang Balita', 'description' => 'Melakukan pengukuran rutin tinggi badan, berat badan, dan lingkar kepala balita untuk deteksi dini stunting di Posyandu.'],
                    ['title' => 'Perbaikan Sanitasi dan Akses Air Bersih', 'description' => 'Meningkatkan akses keluarga terhadap air bersih dan sanitasi layak untuk mencegah penyakit infeksi yang mempengaruhi pertumbuhan anak.'],
                    ['title' => 'Suplementasi Gizi untuk Ibu Hamil', 'description' => 'Pemberian tablet tambah darah dan suplemen gizi untuk ibu hamil guna mencegah anemia dan memastikan janin tumbuh optimal.'],
                    ['title' => 'Pemberdayaan Kader Posyandu', 'description' => 'Melatih dan memberdayakan kader kesehatan untuk melakukan deteksi dini, pencatatan, dan pelaporan kasus stunting di tingkat desa.'],
                ],
                'status' => 'published',
            ],
            [
                'title' => 'Kesehatan Ibu & Anak (KIA)',
                'slug' => 'kesehatan-ibu-anak',
                'subtitle' => 'Pelayanan kesehatan komprehensif untuk ibu dan anak yang meliputi periode pra-konsepsi, kehamilan, persalinan, nifas, dan bayi.',
                'stat_1_num' => null,
                'stat_1_label' => null,
                'stat_2_num' => null,
                'stat_2_label' => null,
                'stat_3_num' => null,
                'stat_3_label' => null,
                'content' => '<h3 class="kia-content-title">Mengapa KIA Penting?</h3>
<p class="kia-content-text">Kesehatan Ibu dan Anak (KIA) adalah fondasi utama dalam membangun generasi bangsa yang sehat dan berkualitas. Periode 1000 Hari Pertama Kehidupan (HPK) merupakan masa emas perkembangan anak yang krusial.</p>
<p class="kia-content-text">Dengan pelayanan KIA yang optimal, kita dapat menurunkan Angka Kematian Ibu (AKI) dan Angka Kematian Bayi (AKB), serta mencegah stunting sejak dini.</p>
<h3 class="kia-content-title">Layanan KIA yang Tersedia</h3>
<ul class="kia-content-list">
    <li><strong>Konsultasi dan pemeriksaan kehamilan rutin</strong> - Pemantauan kesehatan ibu dan janin secara berkala.</li>
    <li><strong>Persalinan di fasilitas kesehatan</strong> - Layanan persalinan aman dan profesional di puskesmas atau rumah sakit.</li>
    <li><strong>Pemeriksaan neonatal dan imunisasi</strong> - Screening bayi baru lahir dan vaksinasi lengkap.</li>
    <li><strong>Pemantauan tumbuh kembang anak</strong> - Pengukuran rutin tinggi badan, berat badan, dan lingkar kepala.</li>
    <li><strong>Pemberian vitamin A dan suplemen gizi</strong> - Suplementasi untuk mencegah defisiensi gizi.</li>
</ul>
<p class="kia-content-text">Semua layanan KIA tersedia secara gratis di Puskesmas dan Fasilitas Kesehatan Primer di seluruh Kabupaten Cianjur.</p>',
                'intervensi' => [
                    ['title' => 'Pelayanan Antenatal Care (ANC)', 'description' => 'Pemeriksaan kehamilan rutin untuk memantau kesehatan ibu dan janin, termasuk USG, laboratorium, dan konseling gizi.'],
                    ['title' => 'Pelayanan Persalinan dan Penolongan Persalinan', 'description' => 'Pelayanan persalinan yang aman dan profesional di fasilitas kesehatan dengan tenaga medis berpengalaman.'],
                    ['title' => 'Pelayanan Postnatal Care (PNC)', 'description' => 'Pemeriksaan dan pendampingan untuk ibu dan bayi setelah persalinan untuk memastikan pemulihan optimal.'],
                    ['title' => 'Imunisasi Bayi dan Anak', 'description' => 'Vaksinasi lengkap sesuai jadwal untuk mencegah penyakit infeksi yang berbahaya pada bayi dan anak.'],
                    ['title' => 'Pelayanan KB Pasca Persalinan', 'description' => 'Pelayanan kontrasepsi setelah persalinan untuk mengatur jarak kelahiran dan kesehatan reproduksi ibu.'],
                    ['title' => 'Pemeriksaan Kesehatan Ibu Nifas', 'description' => 'Pemeriksaan ibu nifas di rumah atau puskesmas untuk mendeteksi dini komplikasi pasca persalinan.'],
                ],
                'status' => 'published',
            ],
        ];

        foreach ($programs as $prog) {
            ProgramKesehatan::updateOrCreate(
                ['slug' => $prog['slug']],
                $prog
            );
        }
    }
}
