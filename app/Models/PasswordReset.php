<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{

    public $timestamps = false;

    protected $fillable = [
        'email',
        'token',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function($model)
        {
            $model->setCreatedAt($model->freshTimestamp());
        });
    }

}