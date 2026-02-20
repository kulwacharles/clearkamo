<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SearchQuery extends Model
{
    protected $fillable = [
        'term',
        'normalized_term',
        'path',
        'source',
        'session_id',
        'ip_address',
        'user_agent',
        'searched_at',
        'day',
        'month_key',
    ];

    protected $casts = [
        'searched_at' => 'datetime',
        'day' => 'date',
    ];
}
