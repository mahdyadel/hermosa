<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

// REQUESTS
use Illuminate\Http\Request;
use App\Http\Requests\API\ForgetPasswordRequest;
use App\Http\Requests\API\ForgetPasswordConfirmRequest;
use App\Http\Requests\API\ForgetPasswordUpdateRequest;

// MAIL
use App\Mail\ResetPassword;
use Illuminate\Support\Facades\Mail;

// REPOSITORIES
use App\Repositories\UserRepo;
use App\Repositories\UserDeviceRepo;

// TRANSFORMERS
use App\Transformers\UserTransformer;

class ForgetPasswordController extends Controller
{
    protected $user;
    protected $userDevice;

    public function __construct(UserRepo $user, UserDeviceRepo $userDevice)
    {
        $this->user       = $user;
        $this->userDevice = $userDevice;
    }

    public function sendResetCode(ForgetPasswordRequest $request)
    {
        // GET CLIENT
        $user = $this->user->userByEmail($request->email);

        // GENERATE RESET CODE AND SAVE IT IN USER'S RECORD
        $reset_code = rand(10000, 99999);

        // SAVE RESET CODE IN DB
        $user->passwordReset()->delete();
        $user->passwordReset()->create(['token' => $reset_code]);

        // SEND RESET CODE TO USER
        $mail['name']       = $user->name;
        $mail['reset_code'] = $reset_code;
        Mail::to($user->email)->send(new ResetPassword($mail));

        // RETURN SUCCESSFUL RESPONSE
        $response['message'] = __('messages.api.auth.reset_code_sent');
        return response()->json($response); 
    }
    
    public function resendResetCode(ForgetPasswordRequest $request)
    {        
        // GET USER
        $user = $this->user->userByEmail($request->email);

        // CHECK THIS USER HAS RESET CODE
        if(!$user->passwordReset)
        {
            $response['message'] = __('messages.api.auth.no_reset_code');
            return response()->json($response, 400);
        }
        
        // SEND RESET CODE TO USER
        $mail['name']       = $user->name;
        $mail['reset_code'] = $user->passwordReset->token;
        Mail::to($user->email)->send(new ResetPassword($mail));

        // RETURN SUCCESSFUL RESPONSE
        $response['message'] = __('messages.api.auth.reset_code_sent');
        return response()->json($response);         
    }

    public function confirmResetCode(ForgetPasswordConfirmRequest $request)
    {
        $user = $this->user->userByEmail($request->email);

        // CHECK IF USER HAS RESET CODE AND RESET CODE IS VALID
        if(!$user->passwordReset || $user->passwordReset->token != $request->reset_code)
        {
            $response['message'] = __('messages.api.auth.invalid_reset_code');
            return response()->json($response, 400);
        }

        // RETURN RESPONSE
        $response['message'] = __('messages.api.auth.valid_reset_code');
        return response()->json($response);
    }
    
    public function updatePassword(ForgetPasswordUpdateRequest $request)
    {
        // GET USER
        $user = $this->user->userByEmail($request->email);

        // CHECK IF USER HAS RESET CODE AND RESET CODE IS VALID
        if(!$user->passwordReset || $user->passwordReset->token != $request->reset_code)
        {
            $response['message'] = __('messages.api.auth.invalid_reset_code');
            return response()->json($response, 400);
        }

        // CHECK IF USER IS UNBLOCKED
        if($user->is_blocked == 1)
        {
            $response['status']  = 'BLOCKED_USER';
            $response['message'] = __('messages.api.auth.user_blocked');
            return response()->json($response, 401);
        }

        // UPDATE PASSWORD AND DELETE RESET CODE TO NULL
        $user->update(['password' => $request->password]);
        $user->passwordReset()->delete();
        
        // GENERATE TOKEN
        $token = auth()->guard('api')->fromUser($user);

        // UPDATE USER DEVICE
        $this->userDevice->loggedIn($request->unique_id, $user->id, $token, $request->fcm_token, $request->headers()->all());
        
        // TRANSFORME USER OBJECT
        $user = fractal($user, new UserTransformer())->toArray();        

        // RETURN SUCCESSFUL RESPONSE
        $response['message'] = __('messages.api.auth.password_updated');
        $response['user']    = $user;
        $response['token']   = $token;
        return response()->json($response);
    }

}
