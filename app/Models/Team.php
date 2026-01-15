<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class Team extends Model
{
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($team) {
            $team->slug = Str::slug($team->name);
        });
                // When updating (only if title changed)
        static::updating(function ($team) {
            if ($team->isDirty('title')) {
                $team->slug = Str::slug($team->name);
            }
        });
    }
}
