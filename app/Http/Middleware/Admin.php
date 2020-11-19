<?php

namespace App\Http\Middleware;
use Auth;

use Closure;

class Admin
{
    
    public function handle($request, Closure $next)
    {
        if ( Auth::check() && Auth::user()->role == "admin") {
            return $next($request);
          }
      
            return redirect('login');
    }
}
