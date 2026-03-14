<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FocusArea extends Model
{
    protected $fillable = ['title', 'summary', 'details', 'icon', 'image', 'sort_order', 'status'];
}
