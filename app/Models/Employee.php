<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'name_ar',
        'name_en',
        'photo',
        'gender',
        'salary',
        'insurance',
        'salon_id',
        'is_active'
    ];

    public function getNameAttribute() {
        return app()->isLocale('ar') ? $this->name_ar : $this->name_en;
    }

    public function getSalonServicesIdsAttribute() {
        return $this->employeeSalonServices()->pluck('salon_service_id')->toArray();
    }

    public function salon() {
        return $this->belongsTo(Salon::class);
    }

    public function employeeSalonServices() {
        return $this->hasMany(EmployeeSalonService::class);
    }

    public function rates() {
        return $this->hasMany(EmployeeRate::class);
    }

    public function portfolio() {
        return $this->hasMany(EmployeePortfolio::class);
    }

    public function reservationServices() {
        return $this->hasMany(ReservationService::class);
    }

    public function getRatesSumAttribute() {
        return $this->rates->avg('rate');
    }

}
