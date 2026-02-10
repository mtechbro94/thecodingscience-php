<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'phone', 'role',
        'is_active', 'is_approved',
        'education', 'expertise', 'experience', 'bio',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
            'is_approved' => 'boolean',
            'experience' => 'integer',
        ];
    }

    // ── Relationships ──

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function assignedCourses()
    {
        return $this->hasMany(Course::class, 'trainer_id');
    }

    public function courseReviews()
    {
        return $this->hasMany(CourseReview::class);
    }

    // ── Role helpers ──

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isTrainer(): bool
    {
        return $this->role === 'trainer';
    }

    public function isStudent(): bool
    {
        return $this->role === 'student';
    }

    public function isPendingApproval(): bool
    {
        return $this->role === 'trainer' && !$this->is_approved;
    }
}
