<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IkmRating extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'whatsapp',
        'rating',
        'description',
        'ip_address',
    ];
}
