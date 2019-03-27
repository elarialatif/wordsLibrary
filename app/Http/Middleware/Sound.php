<?php

namespace App\Http\Middleware;

use App\Helper\UsersTypes;
use Closure;

class Sound
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

        if (auth()->user()->role != UsersTypes::Sound && auth()->user()->role != UsersTypes::SUPERADMIN) {
            return redirect()->back()->withErrors('غير مسموح لك الدخول إلى هنا ');
        }
        return $next($request);
    }
}
