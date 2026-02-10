<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsletterSubscriber extends Model
{
    protected $fillable = ['email', 'is_active'];

    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }
}
