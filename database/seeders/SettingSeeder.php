<?php

namespace Database\Seeders;

use App\Models\SettingFooter;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SettingFooter::firstOrCreate(['id' => 1], [
            'site_name' => 'Dinas Kesehatan Kabupaten Cianjur',
            'site_tagline' => 'Mewujudkan Transformasi Pelayanan Kesehatan Masyarakat yang Profesional, Merata, dan Terintegrasi.',
            'site_logo' => null,
            'address' => 'Jl. Pangeran No. 105, Cianjur, Jawa Barat.',
            'phone' => '(0263) 261XXX',
            'email' => 'kontak@dinkes.cianjurkab.go.id',
            'emergency_call' => '119',
            'emergency_title' => 'Ambulans Gawat Darurat: PSC 119 Cianjur',
            'social_facebook' => 'https://facebook.com',
            'social_instagram' => 'https://instagram.com',
            'social_twitter' => 'https://x.com',
            'social_youtube' => 'https://youtube.com',
            'social_tiktok' => 'https://tiktok.com',
        ]);
    }
}
