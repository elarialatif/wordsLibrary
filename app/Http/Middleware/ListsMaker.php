<?php

namespace App\Http\Middleware;

use App\Helper\UsersTypes;
use Closure;

class ListsMaker
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role = null)
    {
        if ($role && (auth()->user()->role == UsersTypes::LISTMAKER || auth()->user()->role == UsersTypes::SUPERADMIN || auth()->user()->role == UsersTypes::EDITOR)) {
            return $next($request);
        }
        if (auth()->user()->role != UsersTypes::LISTMAKER && auth()->user()->role != UsersTypes::SUPERADMIN) {
            return redirect()->back()->withErrors('غير مسموح لك الدخول إلى هنا ');
        }
        return $next($request);
    }
}
