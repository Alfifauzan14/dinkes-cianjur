<?php

namespace Database\Seeders;

use App\Models\PagodaSehatCard;
use Illuminate\Database\Seeder;

class PagodaSehatSeeder extends Seeder
{
    public function run(): void
    {
        $cards = [
            [
                'title' => 'Dinas Kesehatan',
                'description' => 'Visi misi, struktur organisasi, dan kontak resmi Dinas Kesehatan Cianjur.',
                'image' => 'Assets/layouts/Nav/logo_dinkes_cropped.png',
                'url' => '/profil',
                'order_index' => 1,
            ],
            [
                'title' => 'Puskesmas',
                'description' => 'Informasi dan sebaran alamat 47 Puskesmas se-Kabupaten Cianjur.',
                'image' => 'Assets/home/layanan/image 18.png',
                'url' => null,
                'order_index' => 2,
            ],
            [
                'title' => 'Rumah Sakit',
                'description' => 'Rujukan rumah sakit umum daerah (RSUD) dan swasta mitra BPJS.',
                'image' => 'Assets/home/layanan/image 7.png',
                'url' => null,
                'order_index' => 3,
            ],
            [
                'title' => 'LabKesDa',
                'description' => 'Pemeriksaan laboratorium klinis umum, uji kualitas air, dan makanan.',
                'image' => 'Assets/home/layanan/image 16.png',
                'url' => '/labkesda',
                'order_index' => 4,
            ],
            [
                'title' => 'Repository Data',
                'description' => 'Statistik kesehatan daerah, capaian Germas, stunting, dan dokumen kinerja.',
                'image' => 'Assets/home/layanan/image 15.png',
                'url' => null,
                'order_index' => 5,
            ],
            [
                'title' => 'Agenda Kesehatan',
                'description' => 'Jadwal kampanye kesehatan, imunisasi terpadu, Germas, dan bakti sosial.',
                'image' => 'Assets/home/layanan/image 14.png',
                'url' => null,
                'order_index' => 6,
            ],
            [
                'title' => 'Galeri Kegiatan',
                'description' => 'Dokumentasi foto dan video kegiatan penyuluhan lapangan Dinas Kesehatan.',
                'image' => 'Assets/home/layanan/image 13.png',
                'url' => null,
                'order_index' => 7,
            ],
            [
                'title' => 'Dokumen & Regulasi',
                'description' => 'Unduh formulir izin praktik nakes, berkas keputusan, dan regulasi dinas.',
                'image' => 'Assets/home/layanan/image 17.png',
                'url' => null,
                'order_index' => 8,
            ],
        ];

        foreach ($cards as $card) {
            PagodaSehatCard::create($card);
        }
    }
}
