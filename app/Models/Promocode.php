<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promocode extends Model
{
    protected $fillable = [
        'code',
        'percentage',
        'max_amount',
        'owner_type',
        'max_use',
        'salon_id',
        'expired_at',
        'is_active'
    ];

    public function salon() {
        return $this->belongsTo(Salon::class);
    }
}
