<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Salon extends Model
{
    protected $fillable = [
        'name_ar',
        'name_en',
        'lat',
        'lng',
        'main_photo',
        'logo',
        'phone',
        'phone_2',
        'bank_name',
        'bank_account_number',
        'bank_account_number_pdf',
        'bank_name_2',
        'bank_account_number_2',
        'bank_account_number_2_pdf',
        'tax_number',
        'tax_number_pdf',
        'commercial_register',
        'commercial_register_pdf',
        'percentage',
        'is_active',
        'country_id',
        'city_id',
        'deposit_percentage'
    ];

    public function getNameAttribute() {
        return app()->isLocale('ar') ? $this->name_ar : $this->name_en;
    }

    public function employees() {
        return $this->hasMany(Employee::class);
    }

    public function services() {
        return $this->hasMany(SalonService::class);
    }

    public function rates() {
        return $this->hasMany(SalonRate::class);
    }

    public function offers() {
        return $this->hasMany(SalonServiceOffer::class);
    }

    public function promocodes() {
        return $this->hasMany(Promocode::class);
    }

    public function country() {
        return $this->belongsTo(Country::class);
    }

    public function city() {
        return $this->belongsTo(City::class);
    }

    public function reservations() {
        return $this->hasMany(Reservation::class);
    }

    public function getRatesSumAttribute() {
        return $this->rates->avg('rate');
    }

    public function workingDays() {
        return $this->hasMany(SalonWorkingDay::class);
    }


}
