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
            $publication->slug = static::generateUniqueSlug((string) $publication->title);
        });

        // When updating (only if title changed)
        static::updating(function ($publication) {
            if ($publication->isDirty('title')) {
                $publication->slug = static::generateUniqueSlug((string) $publication->title, (int) $publication->id);
            }
        });
    }

    private static function generateUniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $baseSlug = Str::slug($title);
        if ($baseSlug === '') {
            $baseSlug = 'publication';
        }

        $slug = $baseSlug;
        $counter = 2;

        while (static::query()
            ->where('slug', $slug)
            ->when($ignoreId, fn ($query) => $query->where('id', '!=', $ignoreId))
            ->exists()
        ) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }
}
