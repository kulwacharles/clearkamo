<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaintenanceRoute extends Model
{
    protected $fillable = ['name', 'route_name', 'path', 'is_active', 'message'];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
