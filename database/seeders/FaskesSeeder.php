<?php

namespace Database\Seeders;

use App\Models\Faskes;
use Illuminate\Database\Seeder;

class FaskesSeeder extends Seeder
{
    public function run(): void
    {
        Faskes::truncate();

        $faskesData = [
            // Data faskes akan ditambahkan di sini
        ];

        foreach ($faskesData as $data) {
            Faskes::create($data);
        }

        $this->command->info(count($faskesData).' faskes berhasil di-seed!');
    }
}
