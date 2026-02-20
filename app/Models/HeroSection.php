<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeroSection extends Model
{
    protected $fillable = [
        'title', 'subtitle', 'description', 'image',
        'cta_text', 'cta_link', 'cta2_text', 'cta2_link', 'is_active'
    ];

    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }
}
