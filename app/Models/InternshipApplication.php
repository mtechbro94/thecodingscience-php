<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InternshipApplication extends Model
{
    protected $fillable = [
        'internship_id',
        'internship_role',
        'user_id',
        'name',
        'email',
        'phone',
        'cover_letter',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
