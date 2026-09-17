<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeInfoCard extends Model
{
    protected $table = 'info_card';

    protected $fillable = ['title', 'description', 'icon_name', 'link_url', 'order_index'];
}
