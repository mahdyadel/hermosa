<?php

namespace App\Models;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Hash;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable, HasRoles;

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    protected $guard_name = 'web';

    protected $fillable = [
        'name', 
        'email', 
        'mobile',
        'password',
        'type',
        'is_blocked',
        'points',
        'salon_id',
        'country_id',
        'city_id',
        'birthdate'
    ];

    protected $hidden = [
        'password', 
        'remember_token',
        'permissions',
    ];

    protected $appends = [
        'user_permissions',
    ];

    public function getFirstNameAttribute() {
        return explode(' ', $this->name)[0];
    }

    public function getlastNameAttribute() {
        $arr = explode(' ', $this->name);
        if(count($arr) === 1) return $arr[1];

        $str = "";
        foreach ($arr as $i => $obj) {
            if($i === 0) continue;
            if($i + 1 === count($arr)) {
                $str .= " $obj";
            } else {
                $str .= "$obj";
            }
        }
        return $str;
    }

    public function getUserPermissionsAttribute()
    {
        return $this->permissions->pluck('name')->toArray();
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    public function passwordReset()
    {
        return $this->hasOne(PasswordReset::class, 'email', 'email');
    }

    public function country() {
        return $this->belongsTo(Country::class);
    }

    public function city() {
        return $this->belongsTo(City::class);
    }

}
