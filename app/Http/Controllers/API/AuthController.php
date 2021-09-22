<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;

// REQUESTS
use Illuminate\Http\Request;
use App\Http\Requests\API\SignUpRequest;
use App\Http\Requests\API\LoginRequest;
use App\Http\Requests\API\LogoutRequest;
use App\Http\Requests\API\RefreshTokenRequest;

// REPOSITORIES
use App\Repositories\UserRepo;
use App\Repositories\UserDeviceRepo;

// TRANSFORMERS
use App\Transformers\UserTransformer;

// EXCEPTIONS
use Tymon\JWTAuth\Exceptions\TokenBlacklistedException;


class AuthController extends Controller
{
    protected $user;
    protected $userDevice;

    public function __construct(UserRepo $user, UserDeviceRepo $userDevice)
    {
        $this->user       = $user;
        $this->userDevice = $userDevice;
    }

    public function signup(SignUpRequest $request)
    {    
        $data = $request->except(['first_name', 'last_name']);
        $data['name'] = $request->first_name.' '.$request->last_name;

        // CREATE USER
        $user = $this->user->create($data);

        // GENERATE TOKEN
        $token = auth()->guard('api')->fromUser($user);

        // UPDATE USER DEVICE
        $this->userDevice->loggedIn($request->unique_id, $user->id, $token, $request->fcm_token, $request->header('platform'), $request->header('app_version'));

        // TRANSFORME USER OBJECT
        $user = fractal($user, new UserTransformer())->toArray();

        // RESPONSE
        $response['message'] = __('messages.api.auth.signup');
        $response['user']    = $user;
        $response['token']   = $token;
        return response()->json($response, 201);
    }

    public function login(LoginRequest $request) { 

        // GET USER BY EMAIL AND PASSWORD
        $user = $this->user->userByEmail($request->email);

        // CHECK IF DATA IS CORRECT GENERATE NEW TOKEN
        if(!$user || !auth()->attempt($request->only('email', 'password')))
        {
            $response['status']  = 'INVALID_CREDENTIALS';
            $response['message'] = __('messages.api.auth.invalid_credentials');
            return response()->json($response, 401);
        }

        // CHECK IF USER IS UNBLOCKED
        if($user->is_blocked == 1)
        {
            $response['status']  = 'BLOCKED_USER';
            $response['message'] = __('messages.api.auth.user_blocked');
            return response()->json($response, 401);
        }

        // GENERATE TOKEN
        $token = auth()->guard('api')->fromUser($user);

        // UPDATE USER DEVICE
        $this->userDevice->loggedIn($request->unique_id, $user->id, $token, $request->fcm_token, $request->header('platform'), $request->header('app_version'));

        // TRANSFORME USER OBJECT
        $user = fractal($user, new UserTransformer())->toArray();
        
        // RESPONSE
        $response['message'] = __('messages.api.auth.login');
        $response['user']    = $user;
        $response['token']   = $token;

        return response()->json($response, 200);
    }

    public function logout(LogoutRequest $request)
    {
        // DISTROY JWT TOKEN
        $user = auth()->guard('api')->user();
        auth()->guard('api')->logout();

        // UPDATE USER DEVICE DATA (UPDATE LOGGED IN TIME & SET TOKEN NULL)
        $this->userDevice->loggedOut($request->unique_id, $user->id);

        // RETURN RESPONSE JSON
        return response()->json(['message' => __('messages.api.auth.logout')]);
    }

    public function refreshJWTToken(RefreshTokenRequest $request)
    {
        try
        {
            // REFRESH JWT TOKEN THROUGH OLD TOKEN
            $token = auth()->guard('api')->refresh(true, true);
        
            // GET USER FROM TOKEN
            $user  = auth()->guard('api')->setToken($token)->user();
        
            if($user)
            {
                // UPDATE CURRENT USER DEVICE WITH THE NEW TOKEN
                $this->userDevice->updateTokenByIdUniqueIdUserId($request->unique_id, $user->id, $token);
            }

            // RETURN THE NEW TOKEN IN THE RESPONSE
            return response()->json(['token' => $token]);
        }
        catch(TokenBlacklistedException $e)
        {
            $response['status']  = 'BLACKLISTED_TOKEN';
            $response['message'] = 'token has been blacklisted';
            return response()->json($response, 401);
        }
    }

    public function refreshFCMToken(RefreshTokenRequest $request)
    {
        // CHECK IF THERE IS A USER OR A GUEST
        $userId = auth()->guard('api')->user() ? auth()->guard('api')->user()->id : null ;
        $token  = $userId ? auth()->guard('api')->tokenById($userId) : null ;

        // UPDATE OR CREATE CLIENT DEVICE IF THE DEVICE IS EXIST
        $this->userDevice->updateFCMByUniqueId($request->unique_id, $userId, $token, $request->fcm_token, $request->header('platform'), $request->header('app_version'));
        
        return response()->json(['message' => __('messages.has_been_updated')], 200);
    }

}