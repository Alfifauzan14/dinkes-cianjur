<?php

namespace Database\Seeders;

use App\Models\Galeri;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class GaleriMassSeeder extends Seeder
{
    public function run(): void
    {
        $categories = ['PROGRAM', 'KEGIATAN', 'NASIONAL'];
        $images = ['logo.png'];

        $galeriData = [
            // PROGRAM
            ['title' => 'Penguatan Sinergi Dinas Kesehatan Cianjur Bersama Klinik Utama Rotinsulu', 'category' => 'PROGRAM'],
            ['title' => 'Layanan Siaga Darurat PSC 119 Terintegrasi', 'category' => 'PROGRAM'],
            ['title' => 'Pencapaian Universal Health Coverage (UHC) Kabupaten Cianjur', 'category' => 'PROGRAM'],
            ['title' => 'Program Pendampingan Keluarga Stunting di Desa Lokus', 'category' => 'PROGRAM'],
            ['title' => 'Peluncuran Aplikasi Satu Data Kesehatan Cianjur', 'category' => 'PROGRAM'],
            ['title' => 'Program Orang Tua Asuh Anak Stunting', 'category' => 'PROGRAM'],
            ['title' => 'Bantuan Sosial Pangan Bergizi bagi Balita Stunting', 'category' => 'PROGRAM'],
            ['title' => 'Implementasi Nutri Rice untuk Ibu Hamil', 'category' => 'PROGRAM'],
            ['title' => 'Program Kesehatan Ibu dan Anak (KIA) Terpadu', 'category' => 'PROGRAM'],
            ['title' => 'Sosialisasi Germas Hidup Sehat di Tingkat Kecamatan', 'category' => 'PROGRAM'],
            ['title' => 'Program Skrining Kanker Serviks Gratis', 'category' => 'PROGRAM'],
            ['title' => 'Program Pencegahan Anemia pada Remaja Putri', 'category' => 'PROGRAM'],
            ['title' => 'Program Deteksi Dini Risiko Jantung pada Lansia', 'category' => 'PROGRAM'],
            ['title' => 'Program Pencegahan Diabetes melalui Pola Makan Sehat', 'category' => 'PROGRAM'],
            ['title' => 'Program Pemberdayaan Kader Posyandu', 'category' => 'PROGRAM'],
            ['title' => 'Program Suplementasi Gizi untuk Ibu Hamil', 'category' => 'PROGRAM'],
            ['title' => 'Program Pemantauan Tumbuh Kembang Balita', 'category' => 'PROGRAM'],
            ['title' => 'Program Perbaikan Sanitasi dan Akses Air Bersih', 'category' => 'PROGRAM'],
            ['title' => 'Program Pemberian Makanan Tambahan untuk Balita', 'category' => 'PROGRAM'],
            ['title' => 'Program Edukasi Gizi dan Pola Asuh untuk Orang Tua', 'category' => 'PROGRAM'],

            // KEGIATAN
            ['title' => 'Peringatan Hari Kesehatan Nasional ke-62', 'category' => 'KEGIATAN'],
            ['title' => 'Apel Bersama Dinas Kesehatan Cianjur', 'category' => 'KEGIATAN'],
            ['title' => 'Bakti Sosial Pengobatan Gratis di Desa Cilaku', 'category' => 'KEGIATAN'],
            ['title' => 'Lomba Inovasi Daerah Sektor Kesehatan 2026', 'category' => 'KEGIATAN'],
            ['title' => 'Workshop Peningkatan Kapasitas Tenaga Kesehatan', 'category' => 'KEGIATAN'],
            ['title' => 'Seminar Nasional Penurunan Stunting', 'category' => 'KEGIATAN'],
            ['title' => 'Pelatihan Kader Posyandu Angkatan ke-12', 'category' => 'KEGIATAN'],
            ['title' => 'Rapat Koordinasi Program Kesehatan Kabupaten', 'category' => 'KEGIATAN'],
            ['title' => 'Penganugerahan Pelayanan Publik Terbaik 2026', 'category' => 'KEGIATAN'],
            ['title' => 'Upacara HUT Kemerdekaan di Halaman Dinkes', 'category' => 'KEGIATAN'],
            ['title' => 'Bimbingan Teknis Tenaga Medis Puskesmas', 'category' => 'KEGIATAN'],
            ['title' => 'Workshop Inovasi Pelayanan Kesehatan Digital', 'category' => 'KEGIATAN'],
            ['title' => 'Sosialisasi Penurunan Stunting Terpadu', 'category' => 'KEGIATAN'],
            ['title' => 'Pencanangan Program UHC Kabupaten Cianjur', 'category' => 'KEGIATAN'],
            ['title' => 'Koordinasi Lintas Sektor Penurunan Stunting', 'category' => 'KEGIATAN'],
            ['title' => 'Evaluasi Capaian Program Kesehatan Semester I', 'category' => 'KEGIATAN'],
            ['title' => 'Pembukaan Pelatihan Kader Kesehatan', 'category' => 'KEGIATAN'],
            ['title' => 'Sosialisasi Kartu Indonesia Sehat di Cianjur', 'category' => 'KEGIATAN'],
            ['title' => 'Hari Bergizi Nasional di Kabupaten Cianjur', 'category' => 'KEGIATAN'],
            ['title' => 'Peringatan Hari TBC Sedunia di Cianjur', 'category' => 'KEGIATAN'],

            // NASIONAL
            ['title' => 'Kunjungan Menteri Kesehatan ke Puskesmas Cilaku', 'category' => 'NASIONAL'],
            ['title' => 'Rapat Koordinasi Kesehatan Tingkat Provinsi', 'category' => 'NASIONAL'],
            ['title' => 'Program Nasional Germas di Kabupaten Cianjur', 'category' => 'NASIONAL'],
            ['title' => 'Sosialisasi Vaksinasi COVID-19 Booster', 'category' => 'NASIONAL'],
            ['title' => 'Pencanangan Bulan Imunisasi Nasional', 'category' => 'NASIONAL'],
            ['title' => 'Kunjungan Tim pusat Penilaian Stunting', 'category' => 'NASIONAL'],
            ['title' => 'Penerimaan Penghargaan dari Kemenkes RI', 'category' => 'NASIONAL'],
            ['title' => 'Rakornas Kesehatan Ibu dan Anak', 'category' => 'NASIONAL'],
            ['title' => 'Program Nasional Penurunan Stunting Terpadu', 'category' => 'NASIONAL'],
            ['title' => 'Sosialisasi BPJS Kesehatan bagi Masyarakat', 'category' => 'NASIONAL'],
            ['title' => 'Kunjungan Deputi Bidang Pemberdayaan Kemenkes', 'category' => 'NASIONAL'],
            ['title' => 'Pencanangan Hari Kesehatan Nasional ke-62', 'category' => 'NASIONAL'],
            ['title' => 'Rakernas Pelayanan Kesehatan Primer', 'category' => 'NASIONAL'],
            ['title' => 'Koordinasi Program Indonesia Sehat', 'category' => 'NASIONAL'],
            ['title' => 'Penerimaan Bantuan Obat dari Kemenkes', 'category' => 'NASIONAL'],
            ['title' => 'Sosialisasi Standar Pelayanan Minimal Kesehatan', 'category' => 'NASIONAL'],
            ['title' => 'Evaluasi Program JKN-KIS Tingkat Kabupaten', 'category' => 'NASIONAL'],
            ['title' => 'Pencanangan Desa Sehat di Kabupaten Cianjur', 'category' => 'NASIONAL'],
            ['title' => 'Rakor Pencegahan Stunting Tingkat Nasional', 'category' => 'NASIONAL'],
            ['title' => 'Kunjungan Kerja Komisi IX DPR RI', 'category' => 'NASIONAL'],
        ];

        foreach ($galeriData as $i => $data) {
            $data['image'] = $images[0];
            $data['slug'] = Str::slug($data['title']);

            Galeri::updateOrCreate(
                ['title' => $data['title']],
                $data
            );
        }

        $this->command->info('50 galeri massal berhasil di-seed!');
    }
}
