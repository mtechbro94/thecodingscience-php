<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'course_id',
        'status',
        'payment_method',
        'payment_id',
        'amount_paid',
        'utr',
        'payment_gateway',
        'razorpay_order_id',
        'razorpay_payment_id',
        'razorpay_signature',
        'verified_at',
    ];

    protected function casts(): array
    {
        return [
            'amount_paid' => 'decimal:2',
            'verified_at' => 'datetime',
        ];
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function isVerified(): bool
    {
        return $this->status === 'completed';
    }
}
