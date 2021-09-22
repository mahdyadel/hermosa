<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeSalonService extends Model
{
    protected $table = "employee_salon_service";

    protected $fillable = [
        'salon_id',
        'employee_id',
        'salon_service_id'
    ];

    public function salon() {
        return $this->belongsTo(Salon::class);
    }

    public function salonService() {
        return $this->belongsTo(SalonService::class);
    }

    public function employee() {
        return $this->belongsTo(Employee::class);
    }
}
