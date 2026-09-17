<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PagodaSehatCard extends Model
{
    protected $table = 'pagoda_sehat_card';

    protected $fillable = ['title', 'description', 'image', 'url', 'order_index'];
}
