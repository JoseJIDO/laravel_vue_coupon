<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;

class CheckUserSession
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

        if ($request->session()->exists('user')) {
            return $next($request);
        }

        return redirect('/');
    }
}
