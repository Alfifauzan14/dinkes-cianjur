<?php

namespace Database\Seeders;

use App\Models\PpidKeberatan;
use App\Models\PpidPermohonan;
use Illuminate\Database\Seeder;

class PpidKeberatanSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil permohonan yang ditolak & disetujui untuk keberatan realistis
        $ditolak = PpidPermohonan::where('status', 'ditolak')->first();
        $disetujui = PpidPermohonan::where('status', 'disetujui')->first();
        $pending = PpidPermohonan::where('status', 'pending')->first();

        $data = [];

        if ($ditolak) {
            $data[] = [
                'permohonan_id' => $ditolak->id,
                'token' => $ditolak->token,
                'email' => $ditolak->email ?? 'pemohon@example.com',
                'alasan_keberatan' => 'Saya keberatan atas penolakan permohonan ini. Informasi yang saya minta merupakan informasi publik yang seharusnya dapat diakses sesuai UU KIP No. 14 Tahun 2008 Pasal 2. Permohonan ini ditujukan untuk kepentingan penelitian akademik yang tidak bersifat komersil. Mohon dilakukan peninjauan ulang terhadap keputusan penolakan tersebut.',
                'status' => 'pending',
                'tanggapan_admin' => null,
            ];
        }

        if ($disetujui) {
            $data[] = [
                'permohonan_id' => $disetujui->id,
                'token' => $disetujui->token,
                'email' => $disetujui->email ?? 'pemohon2@example.com',
                'alasan_keberatan' => 'Permohonan saya dinyatakan disetujui, namun dokumen yang diberikan tidak lengkap dan tidak sesuai dengan rincian informasi yang saya minta. Data yang dikirimkan hanya mencakup sebagian kecil dari keseluruhan informasi yang diperlukan untuk penelitian saya.',
                'status' => 'ditanggapi',
                'tanggapan_admin' => 'Terima kasih atas masukan Anda. Setelah kami periksa kembali, dokumen tambahan yang Anda maksud akan segera kami kirimkan ke email yang terdaftar dalam waktu 3 hari kerja. Kami mohon maaf atas ketidaklengkapan dokumen sebelumnya.',
            ];
        }

        if ($pending) {
            $data[] = [
                'permohonan_id' => $pending->id,
                'token' => $pending->token,
                'email' => $pending->email ?? 'pemohon3@example.com',
                'alasan_keberatan' => 'Permohonan saya telah melewati batas waktu 10 hari kerja sejak tanggal pengajuan namun belum ada tanggapan dari pihak PPID. Saya memohon agar permohonan ini segera diproses sesuai ketentuan yang berlaku.',
                'status' => 'pending',
                'tanggapan_admin' => null,
            ];
        }

        foreach ($data as $item) {
            PpidKeberatan::firstOrCreate(
                [
                    'permohonan_id' => $item['permohonan_id'],
                    'email' => $item['email'],
                ],
                $item
            );
        }
    }
}
