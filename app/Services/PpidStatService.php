<?php

namespace App\Services;

use App\Models\Laporan;
use App\Models\Regulasi;

class PpidStatService
{
    public static function summary(): array
    {
        $count = Laporan::count() + Regulasi::count();
        $views = Laporan::sum('views') + Regulasi::sum('views');
        $downloads = Laporan::sum('downloads') + Regulasi::sum('downloads');

        return [
            'count' => $count,
            'views' => $views,
            'downloads' => $downloads,
        ];
    }
}
