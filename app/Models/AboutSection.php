<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutSection extends Model
{
    protected $fillable = ['title', 'content', 'image', 'resume_url', 'skills', 'is_active'];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'skills' => 'array',
        ];
    }
}
