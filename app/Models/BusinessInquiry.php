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
        'job_title',
        'industry',
        'company_size',
        'website',
        'country',
        'city',
        'service_interest',
        'budget_range',
        'timeline',
        'business_summary',
        'challenge_details',
        'goals',
        'additional_details',
        'status',
    ];
}
