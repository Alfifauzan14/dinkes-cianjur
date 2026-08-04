<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = 'settings';

    protected $fillable = [
        'site_name',
        'site_tagline',
        'site_logo',
        'address',
        'phone',
        'email',
        'emergency_call',
        'emergency_title',
        'social_facebook',
        'social_instagram',
        'social_twitter',
        'social_youtube',
        'social_tiktok',
    ];
}
