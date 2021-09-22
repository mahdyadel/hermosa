<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'salon_id',
        'user_id',
        'service_type',
        'status',
        'payment_status',
        'payment_type_id',
        'promocode_id',
        'lat',
        'lng',
        'discount_owner',
        'fixed_price',
        'discount_amount',
        'discounted_price',
        'home_service_fees',
        'tax_amount',
        'final_price',
        'paid_amount',
        'unpaid_amount',
        'salon_profit_amount',
        'hermosa_profit_amount',
        'hermosa_tax_amount',
        'hermosa_profit_amount_after_tax',
        'charity_amount',
        'zakat_amount',
        'hermosa_final_profit_amount',
    ];

    public function salon() {
        return $this->belongsTo(Salon::class);
    }

    public function reservationServices() {
        return $this->hasMany(ReservationService::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function paymentType() {
        return $this->belongsTo(PaymentType::class);
    }

    public function promocode() {
        return $this->belongsTo(Promocode::class);
    }
}
