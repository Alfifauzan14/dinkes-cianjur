<?php

namespace Database\Seeders;

use App\Models\PpidPermohonan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class PpidPermohonanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pastikan dummy KTP ada di storage disk public
        Storage::disk('public')->makeDirectory('ppid/ktp');
        Storage::disk('public')->put('ppid/ktp/dummy_ktp1.jpg', 'fake-image-content');
        Storage::disk('public')->put('ppid/ktp/dummy_ktp2.pdf', '%PDF-1.4 Fake PDF Content');

        $data = [
            [
                'nama_pemohon' => 'Ahmad Subardjo',
                'nik' => '3203011212880001',
                'no_hp' => '081234567890',
                'email' => 'ahmad.subardjo@gmail.com',
                'pekerjaan' => 'Pegawai Swasta',
                'cara_memperoleh' => 'email',
                'alamat' => 'Jl. Raya Cipanas No. 45, Cipanas, Cianjur',
                'foto_ktp' => 'ppid/ktp/dummy_ktp1.jpg',
                'jenis_informasi' => 'anggaran',
                'tujuan_penggunaan' => 'penelitian',
                'rincian_informasi' => 'Rincian Realisasi Anggaran Belanja Dinas Kesehatan Kabupaten Cianjur Tahun Anggaran 2025.',
                'alasan_permohonan' => 'Sebagai bahan penelitian tugas akhir (skripsi) mengenai efektivitas anggaran kesehatan daerah.',
                'format_informasi' => ['softcopy'],
                'status' => 'pending',
                'tanggapan' => null,
            ],
            [
                'nama_pemohon' => 'Siti Aminah',
                'nik' => '3203024505920003',
                'no_hp' => '085712345678',
                'email' => 'siti.aminah92@outlook.com',
                'pekerjaan' => 'Mahasiswa',
                'cara_memperoleh' => 'mengambil_langsung',
                'alamat' => 'Kampung Mande RT 02/RW 04, Mande, Cianjur',
                'foto_ktp' => 'ppid/ktp/dummy_ktp2.pdf',
                'jenis_informasi' => 'program_kesehatan',
                'tujuan_penggunaan' => 'edukasi',
                'rincian_informasi' => 'Data statistik dan sebaran stunting per puskesmas di Kabupaten Cianjur tahun 2024-2025.',
                'alasan_permohonan' => 'Digunakan sebagai referensi penyusunan karya ilmiah mahasiswa kesehatan masyarakat.',
                'format_informasi' => ['softcopy', 'hardcopy'],
                'status' => 'disetujui',
                'tanggapan' => 'Permohonan disetujui. Dokumen cetak dapat diambil di front office PPID Dinas Kesehatan pada jam kerja, atau diunduh melalui email yang dikirimkan.',
            ],
            [
                'nama_pemohon' => 'Hendra Wijaya',
                'nik' => '3203051010800002',
                'no_hp' => '081987654321',
                'email' => 'hendra.wijaya@pers.co.id',
                'pekerjaan' => 'Wartawan / Pers',
                'cara_memperoleh' => 'email',
                'alamat' => 'Perumahan Cianjur Indah Blok C/12, Karangtengah, Cianjur',
                'foto_ktp' => 'ppid/ktp/dummy_ktp1.jpg',
                'jenis_informasi' => 'laporan_kinerja',
                'tujuan_penggunaan' => 'informasi_publik',
                'rincian_informasi' => 'Laporan Kinerja Instansi Pemerintah (LKjIP) Dinas Kesehatan Kabupaten Cianjur tahun 2025 secara lengkap.',
                'alasan_permohonan' => 'Bahan pemberitaan media massa lokal terkait capaian kinerja kesehatan Cianjur.',
                'format_informasi' => ['softcopy'],
                'status' => 'disetujui',
                'tanggapan' => 'Telah dikirimkan softcopy LKjIP Dinas Kesehatan 2025 ke email pemohon.',
            ],
            [
                'nama_pemohon' => 'Rian Hidayat',
                'nik' => '3203082208940004',
                'no_hp' => '082122334455',
                'email' => 'rian.hidayat@yahoo.com',
                'pekerjaan' => 'Wiraswasta',
                'cara_memperoleh' => 'email',
                'alamat' => 'Jl. KH. Abdullah Bin Nuh No. 88, Cianjur Kota',
                'foto_ktp' => 'ppid/ktp/dummy_ktp1.jpg',
                'jenis_informasi' => 'anggaran',
                'tujuan_penggunaan' => 'komersil',
                'rincian_informasi' => 'Data vendor penyedia obat-obatan dan alat kesehatan tahun anggaran 2026.',
                'alasan_permohonan' => 'Untuk penawaran kerja sama bisnis obat-obatan.',
                'format_informasi' => ['softcopy'],
                'status' => 'ditolak',
                'tanggapan' => 'Permohonan ditolak karena informasi yang diminta termasuk dalam kategori rahasia proses pengadaan yang belum selesai, atau berkaitan dengan hak kekayaan intelektual/rahasia dagang pihak ketiga.',
            ],
            [
                'nama_pemohon' => 'Dewi Lestari',
                'nik' => '3203106509890001',
                'no_hp' => '089988776655',
                'email' => 'dewi.lestari@organisasi.org',
                'pekerjaan' => 'Anggota LSM',
                'cara_memperoleh' => 'email',
                'alamat' => 'Kampung Haurwangi RT 01/RW 01, Haurwangi, Cianjur',
                'foto_ktp' => 'ppid/ktp/dummy_ktp2.pdf',
                'jenis_informasi' => 'regulasi',
                'tujuan_penggunaan' => 'penelitian',
                'rincian_informasi' => 'Salinan Peraturan Bupati dan Keputusan Kepala Dinas terbaru mengenai standar operasional Puskesmas.',
                'alasan_permohonan' => 'Pemantauan independen kualitas pelayanan Puskesmas di daerah Haurwangi.',
                'format_informasi' => ['softcopy'],
                'status' => 'pending',
                'tanggapan' => null,
            ],
        ];

        foreach ($data as $item) {
            PpidPermohonan::updateOrCreate(
                ['nik' => $item['nik'], 'jenis_informasi' => $item['jenis_informasi']],
                $item
            );
        }
    }
}
