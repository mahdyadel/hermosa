<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Foundation\Application;

class SwitchLanguage {

    public function __construct(Application $app) {
        $this->app = $app;
    }

    public function handle($request, Closure $next) {
        if(session()->has('locale'))
            app()->setLocale(session('locale'));
        else 
            app()->setLocale(config('app.locale'));
        return $next($request);
    }
}