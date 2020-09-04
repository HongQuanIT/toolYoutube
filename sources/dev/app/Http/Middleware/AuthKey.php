<?php

namespace App\Http\Middleware;

use Closure;

class AuthKey
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
        $token = request()->header('X-CSRF-Token');
        if ($token != 'CZrmLYEkWEWid3AZKfPbpzKBpWQGJCfGOguwEa3x') {
            return response()->json(["message"=>"No find csrf token!"],401);
        }
        return $next($request);
    }
}
