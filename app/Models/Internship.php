<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Internship extends Model
{
    protected $fillable = [
        'role',
        'company',
        'duration',
        'location',
        'stipend',
        'description',
        'image',
        'is_active'
    ];
}
