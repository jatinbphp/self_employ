<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class isAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        
        if(Auth::check() && auth()->user()->role_id == 1){
            return $next($request);
        } 
        return redirect()->route('page.admin.login');
        /**
         * Prodceed to next request
         */
        return $next($request);
    }

    /**
     * Checks if user is logged in as an admin
     */
    private function CheckAdmin()
    {

        /**
         * Check If User Is Logged In
         */
        if (!Auth::check()) {

            return false;
        }

        /**
         * Check If User has administrator role
         */
        if (Auth::user()->role_id != 1) {

            return false;
        }

        //passed Admin rules
        return true;
    }
}
