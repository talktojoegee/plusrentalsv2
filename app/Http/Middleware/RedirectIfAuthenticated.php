<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            switch ($guard){
                case 'manager':
                    return redirect()->route('dashboard');
                    break;
                case 'landlord':
                    return redirect()->route('my-portal');
                    break;
                case 'tenant':
                    return redirect()->route('profile');
                case 'admin':
                    return redirect()->route('duties');
            }

            /*if (Auth::guard($guard)->check()) {
                return redirect(RouteServiceProvider::HOME);
            }*/

        }

        return $next($request);
    }
}
