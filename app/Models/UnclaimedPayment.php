<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UnclaimedPayment extends Model
{
    protected $fillable = ['utr', 'amount', 'sender'];

    protected function casts(): array
    {
        return ['amount' => 'decimal:2'];
    }
}
