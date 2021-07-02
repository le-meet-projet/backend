<?php

namespace App\Http\Middleware;
use Auth;

use Closure;

class Brand
{
	public function handle($request, Closure $next)
	{
		if ( Auth::check() && Auth::user()->role == "brand") {
			return $next($request);
		}
		
		return redirect()->route('merchant.login');
	}
}
