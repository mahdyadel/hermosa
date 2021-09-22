<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeePortfolio extends Model
{
    protected $fillable = [
        'url',
        'type',
        'employee_id',
    ];
}
