<?php

namespace Database\Seeders;

use App\Models\Berita;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BeritaMassSeeder extends Seeder
{
    public function run(): void
    {
        $beritaData = [
            // --- Kegiatan ---
            ['title' => 'Dinkes Cianjur Gelar Sosialisasi Germas Sehat', 'category' => 'Kegiatan', 'content' => 'Dinas Kesehatan Kabupaten Cianjur menggelar sosialisasi Gerakan Masyarakat Hidup Sehat (Germas) di tingkat kecamatan untuk meningkatkan kesadaran masyarakat akan pentingnya pola hidup bersih dan sehat.', 'views' => 1280],
            ['title' => 'Dinkes Raih Penghargaan Pelayanan Publik Terbaik 2026', 'category' => 'Kegiatan', 'content' => 'Dinas Kesehatan Kabupaten Cianjur berhasil mendapatkan penghargaan bergengsi atas dedikasi dan kualitas pelayanan publik bidang kesehatan yang inovatif dan responsif.', 'views' => 3120],
            ['title' => 'Bimbingan Teknis Tenaga Medis Puskesmas 2026', 'category' => 'Kegiatan', 'content' => 'Peningkatan kapasitas pelayanan primer di puskesmas seluruh Kabupaten Cianjur melalui bimbingan teknis dan workshop penanganan pasien.', 'views' => 87],
            ['title' => 'Pelatihan Kader Posyandu Angkatan ke-12', 'category' => 'Kegiatan', 'content' => 'Dinkes Cianjur mengadakan pelatihan intensif bagi 200 kader posyandu se-Kabupaten Cianjur tentang deteksi dini stunting dan gizi balita.', 'views' => 215],
            ['title' => 'Workshop Inovasi Pelayanan Kesehatan Digital', 'category' => 'Kegiatan', 'content' => 'Workshop penggunaan teknologi digital dalam pelayanan kesehatan masyarakat, termasuk sistem antrian online dan telemedicine.', 'views' => 542],
            ['title' => 'Seminar Nasional Penurunan Stunting di Cianjur', 'category' => 'Kegiatan', 'content' => 'Seminar nasional yang menghadirkan pakar gizi dan kesehatan masyarakat untuk membahas strategi percepatan penurunan stunting.', 'views' => 1890],
            ['title' => 'Upacara Hari Kesehatan Nasional ke-62', 'category' => 'Kegiatan', 'content' => 'Peringatan Hari Kesehatan Nasional di halaman Kantor Dinkes Cianjur dengan tema Transformasi Pelayanan Kesehatan.', 'views' => 156],

            // --- Kesehatan ---
            ['title' => 'Langkah Nyata Dinkes Cianjur Menurunkan Angka Stunting', 'category' => 'Kesehatan', 'content' => 'Dalam upaya mempercepat penurunan angka stunting, Dinas Kesehatan berkolaborasi dengan berbagai instansi terkait menyelenggarakan program pemantauan gizi buruk secara intensif.', 'views' => 2450],
            ['title' => 'Penyuluhan Bahaya Demam Berdarah (DBD) di Musim Hujan', 'category' => 'Kesehatan', 'content' => 'Mengantisipasi peningkatan kasus demam berdarah dengue di musim hujan, tim penyuluhan Dinkes Cianjur mengadakan sosialisasi gerakan 3M Plus.', 'views' => 1890],
            ['title' => 'Deteksi Dini Risiko Jantung pada Lansia', 'category' => 'Kesehatan', 'content' => 'Program pemeriksaan kesehatan jantung gratis bagi lansia di seluruh puskesmas Kabupaten Cianjur guna deteksi dini penyakit kardiovaskular.', 'views' => 430],
            ['title' => 'Pencegahan Diabetes melalui Pola Makan Sehat', 'category' => 'Kesehatan', 'content' => 'Edukasi tentang pentingnya pola makan sehat dan olahraga teratur sebagai langkah pencegahan diabetes mellitus tipe 2 di masyarakat.', 'views' => 678],
            ['title' => 'Program Skrining Kanker Serviks Gratis', 'category' => 'Kesehatan', 'content' => 'Dinkes Cianjur menyelenggarakan program skrining kanker serviks gratis bagi perempuan usia 30-50 tahun di seluruh puskesmas.', 'views' => 920],
            ['title' => 'Kesadaran Kesehatan Mental di Tengah Masyarakat', 'category' => 'Kesehatan', 'content' => 'Kampanye kesadaran kesehatan mental dan konseling gratis bagi masyarakat yang membutuhkan bantuan psikologis.', 'views' => 1100],
            ['title' => 'Upaya Cegah DBD dengan Fogging Massal', 'category' => 'Kesehatan', 'content' => 'Fogging massal dilakukan di 15 kecamatan prioritas untuk memutus rantai penularan demam berdarah di musim penghujan.', 'views' => 760],

            // --- Pengumuman ---
            ['title' => 'Imunisasi Polio Serentak di 47 Puskesmas Cianjur', 'category' => 'Pengumuman', 'content' => 'Diberitahukan kepada seluruh masyarakat Kabupaten Cianjur bahwa Dinas Kesehatan menyelenggarakan Pekan Imunisasi Nasional (PIN) Polio serentak.', 'views' => 950],
            ['title' => 'Jadwal Pelayanan Kesehatan Gratis Bulan Agustus 2026', 'category' => 'Pengumuman', 'content' => 'Informasi jadwal pelayanan kesehatan gratis di seluruh puskesmas Kabupaten Cianjur untuk bulan Agustus 2026.', 'views' => 320],
            ['title' => 'Pengumuman Penerimaan Tenaga Kesehatan Kontrak', 'category' => 'Pengumuman', 'content' => 'Dinkes Cianjur membuka penerimaan tenaga kesehatan kontrak untuk posisi perawat, bidan, dan apoteker di puskesmas.', 'views' => 4500],
            ['title' => 'Penutupan Sementara Puskesmas Cijati untuk Renovasi', 'category' => 'Pengumuman', 'content' => 'Puskesmas Cijati akan ditutup sementara selama 2 minggu untuk renovasi gedung dan peningkatan fasilitas pelayanan.', 'views' => 180],
            ['title' => 'Sosialisasi Program JKN-KIS bagi Masyarakat', 'category' => 'Pengumuman', 'content' => 'Sosialisasi program Jaminan Kesehatan Nasional - Kartu Indonesia Sehat bagi masyarakat Kabupaten Cianjur.', 'views' => 650],

            // --- Stunting ---
            ['title' => 'Program Pendampingan Keluarga Stunting di 10 Desa Lokus', 'category' => 'Stunting', 'content' => 'Program pendampingan intensif bagi keluarga dengan balita stunting di 10 desa lokus prioritas Kabupaten Cianjur.', 'views' => 3200],
            ['title' => 'Edukasi Gizi Ibu Hamil untuk Cegah Stunting', 'category' => 'Stunting', 'content' => 'Edukasi gizi seimbang bagi ibu hamil guna mencegah stunting sejak masa kehamilan di seluruh posyandu.', 'views' => 870],
            ['title' => 'Hasil Survei SSGI Kabupaten Cianjur 2026', 'category' => 'Stunting', 'content' => 'Hasil Survei Status Gizi Indonesia menunjukkan penurunan angka stunting di Kabupaten Cianjur dari 18.2% menjadi 9.8%.', 'views' => 5600],
            ['title' => 'Pemberian Makanan Tambahan untuk Balita Stunting', 'category' => 'Stunting', 'content' => 'Program pemberian makanan tambahan bergizi tinggi bagi 3.200 balita stunting dan gizi buruk di Kabupaten Cianjur.', 'views' => 1450],
            ['title' => 'Kader Stunting Desa Binaan Dinkes Cianjur', 'category' => 'Stunting', 'content' => 'Pembentukan dan pelatihan kader stunting di setiap desa binaan untuk mempercepat penurunan prevalensi stunting.', 'views' => 680],

            // --- KIA (Kesehatan Ibu & Anak) ---
            ['title' => 'Program Antenatal Care Gratis untuk Ibu Hamil', 'category' => 'KIA', 'content' => 'Layanan antenatal care gratis di seluruh puskesmas untuk memantau kesehatan ibu dan janin selama masa kehamilan.', 'views' => 2100],
            ['title' => 'Sosialisasi Persalinan Aman di Fasilitas Kesehatan', 'category' => 'KIA', 'content' => 'Sosialisasi pentingnya persalinan di fasilitas kesehatan untuk menurunkan angka kematian ibu dan bayi.', 'views' => 980],
            ['title' => 'Pemeriksaan Ibu Nifas di Rumah oleh Bidan Desa', 'category' => 'KIA', 'content' => 'Program kunjungan rumah oleh bidan desa untuk pemeriksaan ibu nifas dan bayi baru lahir guna deteksi dini komplikasi.', 'views' => 540],

            // --- Gizi ---
            ['title' => 'Pencegahan Anemia pada Remaja Putri', 'category' => 'Gizi', 'content' => 'Program suplementasi tablet tambah darah bagi remaja putri di sekolah-sekolah untuk mencegah anemia defisiensi besi.', 'views' => 390],
            ['title' => 'Edukasi Gizi Seimbang bagi Anak Sekolah', 'category' => 'Gizi', 'content' => 'Penyuluhan gizi seimbang dan pola makan bergizi bagi siswa SD dan SMP di Kabupaten Cianjur.', 'views' => 720],

            // --- Imunisasi ---
            ['title' => 'Capaian Imunisasi Dasar Lengkap di Cianjur', 'category' => 'Imunisasi', 'content' => 'Capaian imunisasi dasar lengkap (IDL) di Kabupaten Cianjur mencapai 94.8% per semester I 2026, melampaui target nasional.', 'views' => 1650],
            ['title' => 'Jadwal Imunisasi MR (Measles Rubella) Agustus 2026', 'category' => 'Imunisasi', 'content' => 'Informasi jadwal imunisasi Measles Rubella (MR) serentak di seluruh puskesmas dan posyandu Kabupaten Cianjur.', 'views' => 2800],
        ];

        foreach ($beritaData as $i => $data) {
            // Buat konten lebih panjang untuk realistis
            $data['content'] .= str_repeat("\n\nParagraf tambahan untuk melengkapi berita ini dengan informasi yang lebih detail dan komprehensif bagi masyarakat Kabupaten Cianjur.", 3);
            $data['slug'] = Str::slug($data['title']).'-'.($i + 1);
            $data['status'] = 'published';
            $data['image'] = null;

            Berita::updateOrCreate(
                ['slug' => $data['slug']],
                $data
            );
        }

        $this->command->info('30 berita massal berhasil di-seed!');
    }
}
