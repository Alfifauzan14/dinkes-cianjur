<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $galeriCategories = [
            ['nama' => 'PROGRAM',  'warna' => '#009966'],
            ['nama' => 'KEGIATAN', 'warna' => '#0284C7'],
            ['nama' => 'NASIONAL', 'warna' => '#D97706'],
        ];

        foreach ($galeriCategories as $cat) {
            $exists = DB::table('kategoris')
                ->where('type', 'galeri')
                ->where('nama', $cat['nama'])
                ->exists();

            if (! $exists) {
                DB::table('kategoris')->insert([
                    'nama' => $cat['nama'],
                    'type' => 'galeri',
                    'warna' => $cat['warna'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }

    public function down(): void
    {
        DB::table('kategoris')
            ->where('type', 'galeri')
            ->whereIn('nama', ['PROGRAM', 'KEGIATAN', 'NASIONAL'])
            ->delete();
    }
};
