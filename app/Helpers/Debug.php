<?php

namespace App\Helpers;

use Auth;
use Request;
use Route;

class Debug
{


	public function get()
	{

		// request info
		$ip =  request()->ip();
		$route = Route::currentRouteAction();
		$parametres = request()->all();
		//	$headers = request()->header();
	//	$bearer = str_limit(request()->bearerToken(), 20) . '[...]';
		$url = Request::url();


		$debug = [
			'url' => $url,
			'ip' => $ip,
			'route' => $route,
			'parametres' => $parametres,
		//	'bearer' => $bearer,
			//	'headers' => $headers,
		];
		return $debug;
	}
}
