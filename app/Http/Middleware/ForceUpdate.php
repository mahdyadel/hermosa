<?php

namespace App\Http\Middleware;

use Closure;

class ForceUpdate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {   
        // CURRENT APPS VERSION
        $currentAndroidVersion = 1;
        $currentIOSVersion     = 1;
        
        // CHECK HEADER PLATFORM
        if($request->header('platform') == "ios"){
            $version = $currentIOSVersion;
        }else{
            $version = $currentAndroidVersion;
        }

        // CHECK HEADER VERSION
        $headerVersion = $request->header('version') ? (int) $request->header('version') : 1 ;

        // CHECK THERE IS FORCE UPDATE OR NOT
        if($headerVersion < $version)
        {
            $response['message'] = "Force Updating Required";
            return response()->json($response, 426); 
        }

        return $next($request);
    }
}
