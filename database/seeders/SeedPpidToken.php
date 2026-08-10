<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SeedPpidToken extends Seeder
{
    public function run(): void
    {
        $permohonans = DB::table('ppid_permohonans')->whereNull('token')->get();

        foreach ($permohonans as $permohonan) {
            do {
                $token = strtoupper(Str::random(7));
            } while (DB::table('ppid_permohonans')->where('token', $token)->exists());

            DB::table('ppid_permohonans')
                ->where('id', $permohonan->id)
                ->update(['token' => $token]);
        }
    }
}
