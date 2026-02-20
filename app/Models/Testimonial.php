<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $fillable = ['name', 'designation', 'company', 'message', 'image', 'rating', 'is_active'];

    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }
}
