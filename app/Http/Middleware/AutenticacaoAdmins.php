<?php

namespace App\Http\Middleware;

use Closure;

class AutenticacaoAdmins
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
        if(!$request->session()->has('admin')){
            return redirect('/');
        }

        return $next($request);
    }
}
