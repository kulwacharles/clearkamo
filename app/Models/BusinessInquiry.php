<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusinessInquiry extends Model
{
    protected $fillable = [
        'full_name',
        'email',
        'phone',
        'company_name',
        'business_summary',
        'status',
    ];
}
