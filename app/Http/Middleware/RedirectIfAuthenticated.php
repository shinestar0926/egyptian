<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\WebAuth;
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
            if ($guard === 'website')
            return redirect()->route('mediacare.index');
            else
            return redirect(RouteServiceProvider::HOME);
        }
     
        

       
        return $next($request);
    }
}
