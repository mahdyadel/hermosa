<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReservationService extends Model
{
    protected $fillable = [
        'salon_service_id',
        'employee_id',
        'date',
        'time',
        'promocode_id',
        'discount_owner',
        'fixed_price',
        'discount_amount',
        'discounted_price',
        'home_service_fees',
        'tax_amount',
        'final_price',
        'salon_profit_amount',
        'hermosa_profit_amount',
        'hermosa_tax_amount',
        'hermosa_profit_amount_after_tax',
        'charity_amount',
        'zakat_amount',
        'hermosa_final_profit_amount',
    ];

    public function salonService() {
        return $this->belongsTo(SalonService::class);
    }

    public function employee() {
        return $this->belongsTo(Employee::class);
    }

    public function promocode() {
        return $this->belongsTo(Promocode::class);
    }
}
