<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PromocodeService extends Model
{
    protected $fillable = [
        'promocode_id',
        'salon_id',
        'service_id',
        'type'
    ];

    public function subServices() {
        return $this->hasMany(PromocodeServices::class, 'id', 's');
    }
}
