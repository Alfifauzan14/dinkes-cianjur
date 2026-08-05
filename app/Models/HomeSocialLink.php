<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeSocialLink extends Model
{
    protected $table = 'social_links';

    protected $fillable = ['platform', 'url', 'order_index'];
}
