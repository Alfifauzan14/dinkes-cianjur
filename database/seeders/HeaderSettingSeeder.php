<?php

namespace Database\Seeders;

use App\Models\HeaderSetting;
use Illuminate\Database\Seeder;

class HeaderSettingSeeder extends Seeder
{
    public function run(): void
    {
        $headers = [
            [
                'page_key' => 'profil',
                'page_name' => 'Tentang Kami',
                'title' => 'Profil Dinas Kesehatan',
                'subtitle' => 'Mengenal lebih dekat Dinas Kesehatan Kabupaten Cianjur, struktur organisasi, tugas pokok dan fungsinya.',
            ],
            [
                'page_key' => 'visi-misi',
                'page_name' => 'Visi & Misi',
                'title' => 'Visi & Misi',
                'subtitle' => 'Arah kebijakan strategis dan komitmen pelayanan kesehatan Dinas Kesehatan Kabupaten Cianjur.',
            ],
            [
                'page_key' => 'struktur-organisasi',
                'page_name' => 'Struktur Organisasi',
                'title' => 'Struktur Organisasi',
                'subtitle' => 'Bagan kepengurusan dan susunan organisasi Dinas Kesehatan Kabupaten Cianjur.',
            ],
            [
                'page_key' => 'layanan-terpadu',
                'page_name' => 'Layanan Terpadu',
                'title' => 'Layanan Terpadu',
                'subtitle' => 'Portal perizinan praktis dan pelayanan informasi terintegrasi bagi masyarakat, faskes, dan tenaga kesehatan.',
            ],
            [
                'page_key' => 'labkesda',
                'page_name' => 'Labkesda',
                'title' => 'Labkesda Cianjur',
                'subtitle' => 'Unit Pelaksana Teknis Daerah (UPTD) pelayanan pengujian sampel klinis dan lingkungan secara profesional.',
            ],
            [
                'page_key' => 'faskes',
                'page_name' => 'Fasilitas Kesehatan',
                'title' => 'Fasilitas Kesehatan',
                'subtitle' => 'Peta sebaran dan daftar lengkap Rumah Sakit, Puskesmas, serta Klinik rujukan di wilayah Cianjur.',
            ],
            [
                'page_key' => 'berita',
                'page_name' => 'Berita & Publikasi',
                'title' => 'Berita & Publikasi',
                'subtitle' => 'Kabar berita terbaru, rilis pers, sosialisasi germas, dan pengumuman resmi Dinas Kesehatan.',
            ],
            [
                'page_key' => 'agenda',
                'page_name' => 'Agenda Kegiatan',
                'title' => 'Agenda Kegiatan',
                'subtitle' => 'Jadwal rapat kerja, sosialisasi program, imunisasi serentak, dan aktivitas kedinasan mendatang.',
            ],
            [
                'page_key' => 'media',
                'page_name' => 'Media & Dokumentasi',
                'title' => 'Media & Dokumentasi',
                'subtitle' => 'Eksplorasi konten visual Dinas Kesehatan Kabupaten Cianjur — dari galeri kegiatan di lapangan hingga infografis data kesehatan.',
            ],
            [
                'page_key' => 'media-galeri',
                'page_name' => 'Galeri Kegiatan',
                'title' => 'Galeri Kegiatan',
                'subtitle' => 'Kumpulan dokumentasi foto dan video dari berbagai acara dan kegiatan Dinas Kesehatan Kabupaten Cianjur.',
            ],
            [
                'page_key' => 'media-infografis',
                'page_name' => 'Infografis',
                'title' => 'Infografis',
                'subtitle' => 'Visualisasi data dan informasi kesehatan Kabupaten Cianjur dalam format poster yang informatif dan mudah dipahami.',
            ],
            [
                'page_key' => 'ppid',
                'page_name' => 'PPID Pembantu',
                'title' => 'PPID Pembantu',
                'subtitle' => 'Layanan Pejabat Pengelola Informasi dan Dokumentasi (PPID) Dinas Kesehatan Kabupaten Cianjur.',
            ],
            [
                'page_key' => 'laporan',
                'page_name' => 'Laporan Kinerja & Keuangan',
                'title' => 'Laporan Dinkes',
                'subtitle' => 'Keterbukaan informasi laporan keuangan prognosis, LKjIP, dan rencana kerja tahunan.',
            ],
            [
                'page_key' => 'regulasi',
                'page_name' => 'Regulasi & Produk Hukum',
                'title' => 'Regulasi & Produk Hukum',
                'subtitle' => 'Himpunan Peraturan Bupati (Perbup) penanggulangan stunting, KIA, dan kebijakan operasional medis.',
            ],
            [
                'page_key' => 'program-kesehatan',
                'page_name' => 'Program Kesehatan',
                'title' => 'Program Kesehatan',
                'subtitle' => 'Daftar program kesehatan unggulan dan inovasi layanan kesehatan di Kabupaten Cianjur.',
            ],
            [
                'page_key' => 'ikm',
                'page_name' => 'Indeks Kepuasan Masyarakat',
                'title' => 'Indeks Kepuasan Masyarakat',
                'subtitle' => 'Hasil evaluasi dan pengukuran tingkat kepuasan masyarakat terhadap pelayanan Dinas Kesehatan.',
            ],
            [
                'page_key' => 'pagoda-sehat',
                'page_name' => 'Pagoda Sehat',
                'title' => 'Pagoda Sehat',
                'subtitle' => 'Platform edukasi dan layanan kesehatan berbasis digital terintegrasi untuk masyarakat Cianjur.',
            ],
            [
                'page_key' => 'statistik',
                'page_name' => 'Satu Data / Statistik',
                'title' => 'Satu Data Kesehatan',
                'subtitle' => 'Portal visualisasi statistik interaktif tren stunting balita, sebaran nakes, dan indikator utama.',
            ],
        ];

        foreach ($headers as $h) {
            HeaderSetting::updateOrCreate(
                ['page_key' => $h['page_key']],
                $h
            );
        }
    }
}
