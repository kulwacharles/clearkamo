<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
        protected $fillable = [
        'physical_address',
        'map',
        'phone',
        'facebook',
        'twiiter',
        'linkedin',
        'instagram',
        'email',
        'youtube',
        'extra_1',
        'extar_2'
    ];
}
