<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Company extends Model
{
    use HasFactory;
    protected $fillable = [
        'company_logo',
        'company_name',
        'email',
        'mobile',
        'services',
        'country',
        'state',
        'city',
        'branch',
    ];

    protected $casts = [
        'services' => 'array',
        'branch' => 'array',
    ];
}
