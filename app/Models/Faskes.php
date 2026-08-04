<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faskes extends Model
{
    protected $fillable = [
        'name',
        'type',
        'kecamatan',
        'address',
        'phone',
        'jam_operasional',
        'lat',
        'lng',
        'layanan',
        'akreditasi',
    ];
}
