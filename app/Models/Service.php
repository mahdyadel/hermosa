<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'name_ar',
        'name_en',
        'description_ar',
        'description_en',
        'image',
        'icon',
        'is_active',
    ];

    public function getNameAttribute() {
        return app()->isLocale('ar') ? $this->name_ar : $this->name_en;
    }

    public function getDescriptionAttribute() {
        return app()->isLocale('ar') ? $this->description_ar : $this->description_en;
    }

    public function salonServices() {
        return $this->hasMany(SalonService::class);
    }

}
