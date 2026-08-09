<?php

namespace Database\Seeders;

use App\Models\LabkesdaCategory;
use App\Models\LabkesdaSetting;
use Illuminate\Database\Seeder;

class LabkesdaSeeder extends Seeder
{
    public function run(): void
    {
        LabkesdaSetting::updateOrCreate(['id' => 1], [
            'alamat' => 'Jl. Raya Cianjur No. 1, Kabupaten Cianjur, Jawa Barat',
            'jam_operasional' => 'Senin - Jumat, 08.00 - 16.00 WIB',
            'kontak' => '(0263) 271 088',
        ]);

        $categories = [
            [
                'title' => 'Pemeriksaan Darah Lengkap',
                'description' => 'Layanan pemeriksaan darah menyeluruh untuk mendeteksi berbagai kondisi kesehatan secara dini.',
                'badge_text' => 'Populer',
                'button_text' => 'Lihat Detail',
                'button_url' => '#',
                'icon_name' => 'bloodtype',
                'order_index' => 1,
                'items' => [
                    'Hemoglobin (Hb)',
                    'Leukosit (White Blood Cell)',
                    'Trombosit',
                    'Hematokrit',
                    'Differensial Leukosit',
                ],
            ],
            [
                'title' => 'Pemeriksaan Kimia Darah',
                'description' => 'Analisis kadar zat kimia dalam darah untuk evaluasi fungsi organ dan metabolisme tubuh.',
                'badge_text' => 'Akurat',
                'button_text' => 'Lihat Detail',
                'button_url' => '#',
                'icon_name' => 'science',
                'order_index' => 2,
                'items' => [
                    'Gula Darah Puasa',
                    'Kolesterol Total',
                    'Trigliserida',
                    'SGOT / SGPT',
                    'Kreatinin',
                    'Ureum',
                ],
            ],
            [
                'title' => 'Pemeriksaan Urin',
                'description' => 'Pengujian sampel urin untuk mendeteksi gangguan saluran kemih, fungsi ginjal, dan kondisi metabolik.',
                'badge_text' => 'Cepat',
                'button_text' => 'Lihat Detail',
                'button_url' => '#',
                'icon_name' => 'water_drop',
                'order_index' => 3,
                'items' => [
                    'Analisis Urin Lengkap',
                    'Protein Urin',
                    'Glukosa Urin',
                    'Ketone Bodies',
                    'Mikroskopik Sedimen',
                ],
            ],
        ];

        foreach ($categories as $catData) {
            $items = $catData['items'];
            unset($catData['items']);

            $category = LabkesdaCategory::updateOrCreate(
                ['title' => $catData['title']],
                $catData
            );

            $category->items()->delete();
            foreach ($items as $index => $itemName) {
                $category->items()->create([
                    'item_name' => $itemName,
                    'order_index' => $index + 1,
                ]);
            }
        }
    }
}
