<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalonServiceOffer extends Model
{
    protected $fillable = [
        'salon_id',
        'salon_service_id',
        'new_price',
        'hours'
    ];

    public function salon() {
        return $this->belongsTo(Salon::class);
    }

    public function salonService() {
        return $this->belongsTo(SalonService::class);
    }
}
