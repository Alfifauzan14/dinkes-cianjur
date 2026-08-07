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
        'balita_stunting',
    ];

    protected $casts = [
        'is_highlighted' => 'boolean',
        'rate' => 'float',
        'balita_stunting' => 'integer',
    ];

    /**
     * Calculate year-over-year change rate.
     */
    public static function calculateRate(?int $current, ?int $previous): float
    {
        if ($previous === 0 || $previous === null || $current === null) {
            return 0.0;
        }

        return round(($current - $previous) / $previous * 100, 1);
    }
}
