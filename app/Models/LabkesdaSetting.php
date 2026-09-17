<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LabkesdaSetting extends Model
{
    protected $table = 'labkesda_setting';

    protected $fillable = ['alamat', 'jam_operasional', 'kontak'];
}
