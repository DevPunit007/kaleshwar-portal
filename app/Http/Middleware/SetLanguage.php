<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

class SetLanguage
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
//        $user = auth()->user();
//        if($user && $user->language_code) { App::setLocale($user->language_code);}
//        else {App::setLocale($request->language);}
        if($request->language) {
            App::setLocale($request->language);
        } else {
            App::setLocale('en');
        }

        return $next($request);
    }
}
