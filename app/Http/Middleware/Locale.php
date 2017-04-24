<?php

namespace App\Http\Middleware;



use Closure;
//use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Session;
use Auth;

class Locale {

    /**
     * The availables languages.
     *
     * @array $languages
     */
    protected $languages = ['en','fr'];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $lang = Session::get('lang');
        app()->setLocale($lang);
        return $next($request);
    }

}