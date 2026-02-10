<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'summary', 'duration',
        'price', 'level', 'image', 'curriculum', 'trainer_id',
    ];

    protected function casts(): array
    {
        return [
            'curriculum' => 'array',
            'price' => 'decimal:2',
        ];
    }

    // ── Relationships ──

    public function trainer()
    {
        return $this->belongsTo(User::class, 'trainer_id');
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function reviews()
    {
        return $this->hasMany(CourseReview::class);
    }

    public function approvedReviews()
    {
        return $this->hasMany(CourseReview::class)->where('is_approved', true);
    }

    // ── Helpers ──

    public function averageRating(): float
    {
        return round($this->approvedReviews()->avg('rating') ?? 0, 1);
    }
}
