<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PpidSetting extends Model
{
    protected $table = 'ppid_settings';

    protected $fillable = [
        'page_title',
        'page_subtitle',
        'stat_1_number', 'stat_1_desc',
        'stat_2_number', 'stat_2_desc',
        'stat_3_number', 'stat_3_desc',
        'tautan_badge', 'tautan_title', 'tautan_subtitle',
        'tautan_1_label', 'tautan_1_url',
        'tautan_2_label', 'tautan_2_url',
        'tautan_3_label', 'tautan_3_url',
        'tautan_4_label', 'tautan_4_url',
        'tautan_5_label', 'tautan_5_url',
        'tata_cara_badge', 'tata_cara_heading',
        'tata_cara_card_1_title', 'tata_cara_card_1_text',
        'tata_cara_card_2_title', 'tata_cara_card_2_text',
        'tata_cara_card_3_title', 'tata_cara_card_3_text',
        'tata_cara_card_4_title', 'tata_cara_card_4_text',
        'btn_daftar_label', 'btn_daftar_url',
        'btn_login_label', 'btn_login_url',
        'accordion_1_title', 'accordion_1_content',
        'accordion_2_title', 'accordion_2_content',
        'accordion_3_title', 'accordion_3_content',
        'accordion_4_title', 'accordion_4_content',
        'accordion_5_title', 'accordion_5_content',
        'accordion_6_title', 'accordion_6_content',
        'accordion_items',
        'tautan_items',
        'tata_cara_items',
        'tata_cara_image',
    ];

    protected $casts = [
        'accordion_items' => 'array',
        'tautan_items' => 'array',
        'tata_cara_items' => 'array',
    ];

    /**
     * Get or initialize the single PPID settings record.
     */
    public static function instance(): static
    {
        return static::firstOrCreate(
            ['id' => 1],
            [
                'page_title' => 'PPID Dinas Kesehatan Kabupaten Cianjur',
                'page_subtitle' => 'Pusat layanan informasi publik, permohonan dokumen resmi, serta transparansi kinerja Dinas Kesehatan.',

                'stat_1_number' => '9.757',
                'stat_1_desc' => 'Jumlah Dokumen (berkala, serta merta & setiap saat) yang tersedia pada database PPID Kabupaten Cianjur.',
                'stat_2_number' => '8.089.450',
                'stat_2_desc' => 'Jumlah Dokumen (berkala, serta merta & setiap saat) sudah di-lihat publik dari database PPID Kabupaten Cianjur.',
                'stat_3_number' => '8.118.414',
                'stat_3_desc' => 'Jumlah Dokumen (berkala, serta merta & setiap saat) sudah di-download publik dari database PPID Kabupaten Cianjur.',

                'tautan_badge' => 'Informasi Tautan',
                'tautan_title' => 'Pelayanan Publik Kabupaten Cianjur',
                'tautan_subtitle' => 'Berikut adalah daftar alamat website pelayanan publik pemerintah kabupaten cianjur.',

                'tautan_1_label' => 'BPJS Kesehatan',
                'tautan_1_url' => '#',
                'tautan_2_label' => 'Pelayanan Pendaftaran Penduduk',
                'tautan_2_url' => '#',
                'tautan_3_label' => 'Pelayanan Perizinan',
                'tautan_3_url' => '#',
                'tautan_4_label' => 'Pelayanan Perizinan Trayek',
                'tautan_4_url' => '#',
                'tautan_5_label' => 'Pelayanan Kearsipan dan Perpustakaan',
                'tautan_5_url' => '#',

                'tata_cara_badge' => '4 langkah mudah pengajuan informasi online',
                'tata_cara_heading' => 'Tata Cara Permohonan',

                'tata_cara_card_1_title' => '1. Persiapan',
                'tata_cara_card_1_text' => 'Silahkan lakukan persiapan terlebih dahulu sebelum melakukan permohonan informasi tentang apa yang anda butuhkan.',
                'tata_cara_card_2_title' => '2. Buat Akun Pemohon',
                'tata_cara_card_2_text' => 'Silahkan buat akun pemohon terlebih dahulu. Jika sudah mempunyai akun, silahkan login melalui menu Layanan Informasi > E-PPID Online.',
                'tata_cara_card_3_title' => '3. Buat Tiket',
                'tata_cara_card_3_text' => 'Silahkan buat tiket dan pilih permohonan informasi. Isi formulir dan upload formulir yang sudah anda isi sebelumnya.',
                'tata_cara_card_4_title' => '4. Selesai',
                'tata_cara_card_4_text' => 'Permohonan anda berhasil dibuat. Anda akan mendapatkan nomor ID Tiket. Permohonan akan diproses 10 hari kerja + 7 hari kerja.',

                'btn_daftar_label' => '1. Mendaftar Akun Pemohon',
                'btn_daftar_url' => '#',
                'btn_login_label' => '2. Login E-PPID Online',
                'btn_login_url' => '#',

                'accordion_1_title' => 'Info Kepuasan Masyarakat',
                'accordion_1_content' => 'Informasi mengenai Indeks Kepuasan Masyarakat (IKM) terhadap layanan Dinas Kesehatan Kabupaten Cianjur disajikan secara berkala untuk menjaga transparansi dan perbaikan berkelanjutan.',
                'accordion_2_title' => 'Permohonan Informasi',
                'accordion_2_content' => 'Alur permohonan informasi publik secara online and offline. Anda dapat mengunduh formulir pengajuan informasi resmi di sini.',
                'accordion_3_title' => 'Tracking Permohonan Informasi',
                'accordion_3_content' => 'Masukkan nomor registrasi permohonan Anda untuk melacak status respon dan tindak lanjut dari petugas PPID Dinas Kesehatan.',
                'accordion_4_title' => 'Standar dan Pelaporan',
                'accordion_4_content' => 'Laporan berkala PPID pembantu, maklumat pelayanan informasi publik, dan standar operasional prosedur (SOP) pengelolaan informasi di lingkungan Dinas Kesehatan.',
                'accordion_5_title' => 'Regulasi PPID Pembantu',
                'accordion_5_content' => 'Kumpulan undang-undang, peraturan pemerintah, peraturan menteri, serta keputusan bupati terkait keterbukaan informasi publik (KIP).',
                'accordion_6_title' => 'Tracking Pengaduan Masyarakat',
                'accordion_6_content' => 'Lacak status laporan pengaduan masyarakat yang diajukan secara resmi ke Dinas Kesehatan Kabupaten Cianjur.',
                'accordion_items' => [
                    ['title' => 'Info Kepuasan Masyarakat', 'content' => 'Informasi mengenai Indeks Kepuasan Masyarakat (IKM) terhadap layanan Dinas Kesehatan Kabupaten Cianjur disajikan secara berkala untuk menjaga transparansi dan perbaikan berkelanjutan.', 'category' => 'berkala'],
                    ['title' => 'Permohonan Informasi', 'content' => 'Alur permohonan informasi publik secara online and offline. Anda dapat mengunduh formulir pengajuan informasi resmi di sini.', 'category' => 'setiap-saat'],
                    ['title' => 'Tracking Permohonan Informasi', 'content' => 'Masukkan nomor registrasi permohonan Anda untuk melacak status respon dan tindak lanjut dari petugas PPID Dinas Kesehatan.', 'category' => 'setiap-saat'],
                    ['title' => 'Standar dan Pelaporan', 'content' => 'Laporan berkala PPID pembantu, maklumat pelayanan informasi publik, dan standar operasional prosedur (SOP) pengelolaan informasi di lingkungan Dinas Kesehatan.', 'category' => 'berkala'],
                    ['title' => 'Regulasi PPID Pembantu', 'content' => 'Kumpulan undang-undang, peraturan pemerintah, peraturan menteri, serta keputusan bupati terkait keterbukaan informasi publik (KIP).', 'category' => 'serta-merta'],
                    ['title' => 'Tracking Pengaduan Masyarakat', 'content' => 'Lacak status laporan pengaduan masyarakat yang diajukan secara resmi ke Dinas Kesehatan Kabupaten Cianjur.', 'category' => 'setiap-saat'],
                ],
                'tautan_items' => [
                    ['label' => 'BPJS Kesehatan', 'url' => '#', 'image' => null],
                    ['label' => 'Pelayanan Pendaftaran Penduduk', 'url' => '#', 'image' => null],
                    ['label' => 'Pelayanan Perizinan', 'url' => '#', 'image' => null],
                    ['label' => 'Pelayanan Perizinan Trayek', 'url' => '#', 'image' => null],
                    ['label' => 'Pelayanan Kearsipan dan Perpustakaan', 'url' => '#', 'image' => null],
                ],
                'tata_cara_items' => [
                    ['title' => '1. Persiapan', 'text' => 'Silahkan lakukan persiapan terlebih dahulu sebelum melakukan permohonan informasi tentang apa yang anda butuhkan.'],
                    ['title' => '2. Buat Akun Pemohon', 'text' => 'Silahkan buat akun pemohon terlebih dahulu. Jika sudah mempunyai akun, silahkan login melalui menu Layanan Informasi > E-PPID Online.'],
                    ['title' => '3. Buat Tiket', 'text' => 'Silahkan buat tiket dan pilih permohonan informasi. Isi formulir dan upload formulir yang sudah anda isi sebelumnya.'],
                    ['title' => '4. Selesai', 'text' => 'Permohonan anda berhasil dibuat. Anda akan mendapatkan nomor ID Tiket. Permohonan akan diproses 10 hari kerja + 7 hari kerja.'],
                ],
                'tata_cara_image' => null,
            ]
        );
    }
}
