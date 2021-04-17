<?php

namespace App\Http\Middleware;

use Closure;

class RevisarEstablecimiento
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

        // dd('Desde middleware');

         if(Auth()->user()->establecimiento){
             return redirect()->route('establecimiento.edit',['establecimiento' => Auth()->user()->establecimiento->id]);
         }

        //  dd(Auth()->user()->establecimiento);
        /**
         *  Nota: si ya tiene un establecimeinto lo redireccionamos
         */

        return $next($request);
    }
}
