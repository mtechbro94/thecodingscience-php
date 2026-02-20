<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialLink extends Model
{
    protected $fillable = ['platform', 'url', 'icon', 'order', 'is_active'];

    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }

    public static function getIcons(): array
    {
        return [
            'github' => 'fab fa-github',
            'linkedin' => 'fab fa-linkedin',
            'twitter' => 'fab fa-twitter',
            'instagram' => 'fab fa-instagram',
            'facebook' => 'fab fa-facebook',
            'youtube' => 'fab fa-youtube',
            'tiktok' => 'fab fa-tiktok',
            'whatsapp' => 'fab fa-whatsapp',
            'telegram' => 'fab fa-telegram',
            'email' => 'fas fa-envelope',
            'website' => 'fas fa-globe',
            'medium' => 'fab fa-medium',
            'stackoverflow' => 'fab fa-stack-overflow',
            'codepen' => 'fab fa-codepen',
        ];
    }
}
