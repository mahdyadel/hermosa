<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $fillable = [
        'name_ar',
        'name_en',
        'description_ar',
        'description_en',
        'duration',
        'amount',
        'discount_percentage',
        'color',
        'is_active',
        'image',
    ];

    public function getNameAttribute() {
        return app()->isLocale('ar') ? $this->name_ar : $this->name_en;
    }
}
