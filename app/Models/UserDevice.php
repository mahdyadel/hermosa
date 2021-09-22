<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserDevice extends Model
{
    protected $fillable = [
        'unique_id',
        'user_id',
        'fcm_token',
        'jwt_token',
        'loggedin_at',
        'loggedin_out',
        'platform',
        'app_version',
    ];
}
