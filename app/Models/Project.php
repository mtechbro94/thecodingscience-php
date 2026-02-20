<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Project extends Model
{
    protected $fillable = [
        'title', 'slug', 'description', 'content', 'image',
        'client_name', 'project_url', 'github_url', 'technologies',
        'order', 'is_featured', 'is_active'
    ];

    protected function casts(): array
    {
        return [
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (Project $project) {
            if (empty($project->slug)) {
                $project->slug = Str::slug($project->title);
            }
        });
    }

    public function getTechnologiesArray(): array
    {
        return $this->technologies ? explode(',', $this->technologies) : [];
    }
}
