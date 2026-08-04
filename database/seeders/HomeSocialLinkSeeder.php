<?php

namespace Database\Seeders;

use App\Models\HomeSocialLink;
use Illuminate\Database\Seeder;

class HomeSocialLinkSeeder extends Seeder
{
    public function run(): void
    {
        $links = [
            ['platform' => 'instagram', 'url' => null, 'order_index' => 1],
            ['platform' => 'tiktok', 'url' => null, 'order_index' => 2],
            ['platform' => 'facebook', 'url' => null, 'order_index' => 3],
            ['platform' => 'youtube', 'url' => null, 'order_index' => 4],
        ];

        foreach ($links as $link) {
            HomeSocialLink::updateOrCreate(['platform' => $link['platform']], $link);
        }
    }
}
