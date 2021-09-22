<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PackageSalonService extends Model
{
    protected $table = "package_salon_service";

    protected $fillable = [
        'salon_id',
        'package_id',
        'salon_service_id'
    ];

    public function salon() {
        return $this->belongsTo(Salon::class);
    }

    public function salonService() {
        return $this->belongsTo(SalonService::class);
    }

    public function package() {
        return $this->belongsTo(Package::class);
    }
}
