<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WebsiteVisit extends Model
{
    protected $fillable = [
        'session_id',
        'ip_address',
        'path',
        'referrer',
        'month_key',
        'day',
        'visited_at',
        'user_agent',
    ];

    protected $casts = [
        'day' => 'date',
        'visited_at' => 'datetime',
    ];
}
