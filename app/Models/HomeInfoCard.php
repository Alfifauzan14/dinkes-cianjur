<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeInfoCard extends Model
{
    protected $table = 'info_cards';

    protected $fillable = ['title', 'description', 'icon_name', 'order_index'];
}
