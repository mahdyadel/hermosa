<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = [
        'name_ar',
        'name_en',
        'country_code',
        'mobile_length',
        'flag',
        'is_active'
    ];

    public function cities() {
        return $this->hasMany(City::class);
    }

    public function getNameAttribute() {
        return app()->isLocale('ar') ? $this->name_ar : $this->name_en;
    }
}
