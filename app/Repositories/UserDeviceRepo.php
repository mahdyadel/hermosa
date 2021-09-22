<?php 

namespace App\Repositories;

use App\Models\UserDevice;

class UserDeviceRepo extends Repository
{
    protected $model;

    public function __construct(UserDevice $model)
    {
        $this->model = $model;
    }

    public function loggedIn($uniqueId, $userId, $token, $fcm_token, $platform, $app_version)
    {
        return $this->model->updateOrCreate([
            'unique_id'     => $uniqueId,
            'user_id'       => $userId,
        ],[
            'unique_id'     => $uniqueId,
            'user_id'       => $userId,
            'fcm_token'     => $fcm_token,
            'jwt_token'     => $token,
            'loggedin_at'   => date("Y-m-d H:i:s"),
            'loggedout_at'  => null,
            'platform'      => $platform,
            'app_version'   => $app_version,
        ]);
    }

    public function loggedOut($uniqueId, $userId)
    {
        return $this->model
        ->where('unique_id', $uniqueId)
        ->where('user_id', $userId)
        ->update([
            'jwt_token'     => null,
            'loggedin_at'   => null,
            'loggedout_at'  => date("Y-m-d H:i:s"),
        ]);
    }

    public function updateTokenByIdUniqueIdUserId($uniqueId, $userId, $token)
    {
        return $this->model->where('user_id', $userId)
        ->where('unique_id', $uniqueId)
        ->update(['jwt_token' => $token]);
    }

    public function updateFCMByUniqueId($uniqueId, $userId, $token, $fcm_token, $platform, $app_version)
    {
        $device = $this->model->updateOrCreate([
            'unique_id'     => $uniqueId,
            'user_id'       => $userId,
        ],[
            'unique_id'     => $uniqueId,
            'user_id'       => $userId,
            'fcm_token'     => $fcm_token,
            'jwt_token'     => $token,
            'platform'      => $platform,
            'app_version'   => $app_version,
        ]);

        if($device->wasRecentlyCreated)
        {
            $device->loggedin_at = date("Y-m-d H:i:s");
            $device->save();
        }

        return $device;
    }


}