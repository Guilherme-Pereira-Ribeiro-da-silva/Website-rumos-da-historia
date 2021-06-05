<?php

namespace App\Http\Middleware;
use Illuminate\Http\Request;

use Closure;

class AutenticacaoAlunos
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(!$request->session()->has('aluno')){
            return redirect('/');
        }

        return $next($request);
    }
}
