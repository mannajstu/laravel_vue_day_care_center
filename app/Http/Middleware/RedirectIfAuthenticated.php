<?php

namespace App\Http\Middleware;

use app\User;
use Closure;
use Illuminate\Support\Facades\Auth;
use Session;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            $roles = auth()->user()->roles()->get();
            $role  = false;

            foreach ($roles as $urole) {
                if ($urole->name === Session::get('role')) {
                    $role = true;
                }
            }
            $activeuser = Auth::user()->active;
            if ($role && $activeuser === 1) {
                return redirect('/home');
            } else {
                Auth::logout();

                return redirect('/notfound');
            }

        }

        return $next($request);
    }
}
