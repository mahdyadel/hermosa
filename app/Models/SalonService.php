<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalonService extends Model
{
    protected $fillable = [
        'name_ar',
        'name_en',
        'price',
        'minutes',
        'home_service',
        'home_service_fees',
        'service_id',
        'salon_id',
        'is_active',
    ];

    public function getNameAttribute() {
        return app()->isLocale('ar') ? $this->name_ar : $this->name_en;
    }

    public function getEmployeesIdsAttribute() {
        return $this->employees()->pluck('employee_id')->toArray();
    }

    public function getPackagesIdsAttribute() {
        return $this->packages()->pluck('package_id')->toArray();
    }

    public function service() {
        return $this->belongsTo(Service::Class);
    }

    public function salon() {
        return $this->belongsTo(Salon::Class);
    }

    public function employees() {
        return $this->hasMany(EmployeeSalonService::class);
    }

    public function packages() {
        return $this->hasMany(PackageSalonService::class);
    }
}
