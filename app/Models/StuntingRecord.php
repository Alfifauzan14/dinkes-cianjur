<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StuntingRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'year',
        'rate',
        'is_highlighted',
        'total_balita',
        'balita_stunting',
        'wilayah_terendah',
        'wilayah_tertinggi',
        'catatan',
    ];

    protected $casts = [
        'is_highlighted' => 'boolean',
        'rate' => 'float',
        'total_balita' => 'integer',
        'balita_stunting' => 'integer',
    ];

    /**
     * Calculate prevalence rate from raw data.
     */
    public static function calculateRate(int $totalBalita, int $balitaStunting): float
    {
        if ($totalBalita === 0) {
            return 0.0;
        }

        return round(($balitaStunting / $totalBalita) * 100, 1);
    }
}
