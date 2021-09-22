<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentType extends Model
{
    //

    public function getNameAttribute() {
        return app()->isLocale('ar') ? $this->name_ar : $this->name_en;
    }
}
