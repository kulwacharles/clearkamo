<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WhoWeAre extends Model
{
    use HasFactory;

    protected $table = 'who_we_are';

    protected $fillable = [
        'title',
        'description',
        'image_path',
        'secondary_image_path',
        'years_of_experience',
        'youtube_url',
    ];
}
