<?php

namespace App\Http\Middleware;

use Closure;

class localization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
     const SESSION_KEY = 'lang';
    const LOCALES = ['en', 'ar','fr','tr','de'];
    public function handle($request, Closure $next)
    {
          $session = $request->getSession();

          if (!$session->has(self::SESSION_KEY)) {
            $session->put(self::SESSION_KEY, 'en');
          }

          if ($request->has('lang')) {
            $lang = $request->get('lang');
            if (in_array($lang, self::LOCALES)) {
              $session->put(self::SESSION_KEY, $lang);
            }
          }

          app()->setLocale($session->get(self::SESSION_KEY));

           
        return $next($request);
    }
}
