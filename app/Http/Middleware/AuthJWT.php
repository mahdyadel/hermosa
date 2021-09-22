<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\TokenBlacklistedException;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class AuthJWT extends BaseMiddleware 
{
    protected $jwtauth;

    public function __construct(JWTAuth $jwtauth) {
        $this->jwtauth = $jwtauth;
    }

    public function handle($request, Closure $next) {

        try 
        {
            $user = $this->jwtauth->parseToken()->authenticate();

            if (!$user) {
                $response['status']  = 'DELETED_USER';
                $response['message'] = 'user has been deleted';
                return response()->json($response, 401);
            }

            if($user->is_blocked == 1)
            {
                $response['status']  = 'BLOCKED_USER';
                $response['message'] = 'user has been blocked';
                return response()->json($response, 401);
            }

        }
        catch(TokenExpiredException $e)
        {
            $response['status']  = 'EXPIRED_TOKEN';
            $response['message'] = 'token has expired';
            return response()->json($response, 401);
        }
        catch(TokenBlacklistedException $e)
        {
            $response['status']  = 'BLACKLISTED_TOKEN';
            $response['message'] = 'token has been blacklisted';
            return response()->json($response, 401);
        }
        catch(TokenInvalidException $e)
        {
            $response['status']  = 'INVALID_TOKEN';
            $response['message'] = 'token is invalid';
            return response()->json($response, 401);
        }
        catch(JWTException $e)
        {
            $response['status']  = 'TOKEN_REQUIRED';
            $response['message'] = 'token is required';
            return response()->json($response, 401);
        }

        return $next($request);
    }
    
}