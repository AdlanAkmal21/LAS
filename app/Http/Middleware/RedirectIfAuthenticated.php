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
    public function handle($request, Closure $next, $guard = null) {
        if (Auth::guard($guard)->check()) {
         $role = Auth::user()->role_id;
         
            if(!(Auth::user()->emp_status_id == 2)){
              switch ($role) {
                case 1:
                  return '/admins';
                  break;
                case 2:
                  return '/employees';
                  break; 
                case 3:
                  return '/approvers';
                  break; 
        
                default:
                  return '/'; 
                break;
              }
            }
        }

        return $next($request);
      }
}
