<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Project extends Model
{
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($project) {
            $project->slug = Str::slug(self::nameForSlug($project));
        });

        static::updating(function ($project) {
            if ($project->isDirty('title') || $project->isDirty('project_name')) {
                $project->slug = Str::slug(self::nameForSlug($project));
            }
        });
    }

    private static function nameForSlug(self $project): string
    {
        return (string) ($project->title ?? $project->project_name ?? '');
    }
}
