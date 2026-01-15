<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class Publication extends Model
{
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($publication) {
            $publication->slug = Str::slug($publication->title);
        });
                // When updating (only if title changed)
        static::updating(function ($publication) {
            if ($publication->isDirty('title')) {
                $publication->slug = Str::slug($publication->title);
            }
        });
    }
}
