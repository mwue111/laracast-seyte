<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MustBeAdministrator
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        //No uso este código porque php7.4 no lo acepta
        // if(auth()->user()?->username !== 'test') {
        //     abort(Response::HTTP_FORBIDDEN);
        // }

        if(auth()->guest()){
            abort(Response::HTTP_FORBIDDEN);    //abort(403): FORBIDEN
        }

        //Ningún usuario que no sea test puede entrar:
        if(auth()->user()->username !== 'admin') {
            abort(Response::HTTP_FORBIDDEN);
        }

        return $next($request);
    }
}
