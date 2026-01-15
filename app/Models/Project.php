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
            $project->slug = Str::slug($project->project_name);
        });
                // When updating (only if title changed)
        static::updating(function ($project) {
            if ($project->isDirty('title')) {
                $project->slug = Str::slug($project->project_name);
            }
        });
    }
}
