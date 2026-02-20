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
            $team->slug = self::makeUniqueSlug((string) $team->name);
        });

        static::updating(function ($team) {
            if ($team->isDirty('name')) {
                $team->slug = self::makeUniqueSlug((string) $team->name, $team->id);
            }
        });
    }

    private static function makeUniqueSlug(string $name, ?int $ignoreId = null): string
    {
        $base = Str::slug($name);
        $slug = $base !== '' ? $base : 'team-member';
        $counter = 2;

        while (self::query()
            ->where('slug', $slug)
            ->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))
            ->exists()) {
            $slug = $base . '-' . $counter;
            $counter++;
        }

        return $slug;
    }
}
