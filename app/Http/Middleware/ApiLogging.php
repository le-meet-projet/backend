<?php

namespace App\Http\Middleware;

use App\Http\Helpers\Debug;
use Closure;
use Illuminate\Support\Facades\Log;

class ApiLogging
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
        $response = $next($request);
        $api_log =  base_path() . '/storage/logs/api.json';;
        $json = json_decode(file_get_contents($api_log), TRUE) ?? [];
        $json[] = (new \App\Helpers\Debug())->get();
        $result = json_encode($json);
        \File::put($api_log, $result);
        return $response;
    }
}
