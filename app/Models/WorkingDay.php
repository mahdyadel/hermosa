<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkingDay extends Model
{
    public function salonWorkingDays() {
        return $this->hasMany(SalonWorkingDay::class);
    }
    public function getNameAttribute() {
        return app()->isLocale('ar') ? $this->name_ar : $this->name_en;
    }
}
