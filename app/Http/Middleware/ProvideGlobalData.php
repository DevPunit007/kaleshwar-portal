<?php

namespace App\Http\Middleware;

use App\File;
use Closure;
use Illuminate\Support\Facades\View;
use stdClass;

class ProvideGlobalData
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
        $user = auth()->user();
        if ($user) {
            $globalData = new stdClass();
            $globalData->profile_image = $user->files->where('type', 'profile-image')->first();

            View::share('globalData', $globalData);
        }

        return $next($request);
    }
}
