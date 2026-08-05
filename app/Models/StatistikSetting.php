<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatistikSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'status_badge',
        'indikator_data',
        'stat_1_num',
        'stat_1_badge',
        'stat_1_caption',
        'stat_2_num',
        'stat_2_badge',
        'stat_2_caption',
        'stat_3_num',
        'stat_3_badge',
        'stat_3_caption',
        'stat_4_num',
        'stat_4_badge',
        'stat_4_caption',
        'stunting_title',
        'stunting_subtitle',
        'stunting_trend_badge',
        'stunting_footer_note',
        'nakes_data',
        'sebaran_data',
    ];

    protected $casts = [
        'indikator_data' => 'array',
        'nakes_data' => 'array',
        'sebaran_data' => 'array',
    ];
}
