<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalonWorkingDay extends Model
{
    protected $fillable = [
        'salon_id',
        'working_day_id',
        'time_from',
        'time_to',
    ];

    public function workingDay() {
        return $this->belongsTo(WorkingDay::class);
    }
}
