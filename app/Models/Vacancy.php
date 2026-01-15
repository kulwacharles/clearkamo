<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class Vacancy extends Model
{
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($vacancy) {
            $vacancy->slug = Str::slug($vacancy->title);
        });
                // When updating (only if title changed)
        static::updating(function ($vacancy) {
            if ($vacancy->isDirty('title')) {
                $vacancy->slug = Str::slug($vacancy->title);
            }
        });
    }
}
