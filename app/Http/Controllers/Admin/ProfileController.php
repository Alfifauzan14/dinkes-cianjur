<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    /**
     * Show the form for editing the profile settings.
     */
    public function edit()
    {
        $profile = Profile::firstOrCreate([
            'id' => 1
        ], [
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
            'visi_title' => 'Mewujudkan Masyarakat Kabupaten Cianjur yang Sehat, Mandiri, Berkeadilan, dan Berdaya Saing.',
            'visi_desc' => 'Dinas Kesehatan Kabupaten Cianjur berkomitmen penuh mendorong transformasi pelayanan kesehatan agar seluruh warga memiliki akses yang setara, cepat, dan terjangkau terhadap layanan medis berkualitas.',
            'stat_1_text' => '47 Puskesmas Rujukan',
            'stat_2_text' => '32 Kecamatan Terjangkau',
            
            'misi_1_title' => '1. Pemerataan Pelayanan',
            'misi_1_desc' => 'Menjamin ketersediaan layanan kesehatan yang merata, cepat, dan terjangkau bagi seluruh masyarakat.',
            'misi_2_title' => '2. Tata Kelola Adil',
            'misi_2_desc' => 'Membangun manajemen pelayanan kesehatan yang efisien, transparan, dan berbasis teknologi informasi.',
            'misi_3_title' => '3. SDM Profesional',
            'misi_3_desc' => 'Meningkatkan kompetensi, kuantitas, dan penyebaran tenaga kesehatan yang berkualitas.',
            'misi_4_title' => '4. Kemandirian Masyarakat',
            'misi_4_desc' => 'Mendorong promosi kesehatan agar masyarakat mampu hidup bersih dan sehat secara mandiri.',
            'misi_5_title' => '5. Mutu Pelayanan',
            'misi_5_desc' => 'Meningkatkan mutu pelayanan yang berorientasi pada kepuasan pasien di seluruh fasilitas.',
            'misi_6_title' => '6. Ketahanan Kesehatan',
            'misi_6_desc' => 'Memperkuat sistem kesiapsiagaan dalam penanggulangan penyakit menular secara berkelanjutan.',
        ]);

        return view('admin.profil.edit', compact('profile'));
    }

    /**
     * Update the profile settings in storage.
     */
    public function update(Request $request)
    {
        $rules = [
            'kepala_dinas_name' => 'required|string|max:255',
            'kepala_dinas_role' => 'required|string|max:255',
            'sambutan_title' => 'required|string|max:255',
            'sambutan_quote' => 'required|string',
            'sambutan_desc_1' => 'required|string',
            'sambutan_desc_2' => 'required|string',
            'kepala_dinas_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'sejarah_title' => 'required|string|max:255',
            'sejarah_text_1' => 'required|string',
            'sejarah_text_2' => 'required|string',
            'sejarah_image' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:2048',
            'visi_title' => 'required|string',
            'visi_desc' => 'required|string',
            'stat_1_text' => 'required|string|max:255',
            'stat_2_text' => 'required|string|max:255',
            'misi' => 'required|array|min:1',
            'misi.*.title' => 'required|string|max:255',
            'misi.*.desc' => 'required|string',
        ];

        $request->validate($rules);

        $profile = Profile::firstOrCreate(['id' => 1]);

        $data = $request->except(['kepala_dinas_image', 'sejarah_image', '_token', '_method']);

        // Handle Kepala Dinas Image
        if ($request->hasFile('kepala_dinas_image')) {
            $image = $request->file('kepala_dinas_image');
            $imageName = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();

            $destinationPath = public_path('uploads/profile');
            if (!File::isDirectory($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true, true);
            }

            // Hapus gambar lama jika ada dan bukan bawaan seeder
            if ($profile->kepala_dinas_image && $profile->kepala_dinas_image !== 'Group 83.png') {
                $oldImagePath = public_path('uploads/profile/' . $profile->kepala_dinas_image);
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            }

            $image->move($destinationPath, $imageName);
            $data['kepala_dinas_image'] = $imageName;
        }

        // Handle Sejarah Image
        if ($request->hasFile('sejarah_image')) {
            $image = $request->file('sejarah_image');
            $imageName = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();

            $destinationPath = public_path('uploads/profile');
            if (!File::isDirectory($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true, true);
            }

            if ($profile->sejarah_image) {
                $oldImagePath = public_path('uploads/profile/' . $profile->sejarah_image);
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            }

            $image->move($destinationPath, $imageName);
            $data['sejarah_image'] = $imageName;
        }

        $profile->update($data);

        return redirect()->route('admin.profil.edit')->with('success', 'Profil instansi berhasil diperbarui!');
    }
}
