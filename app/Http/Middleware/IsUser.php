<?php

namespace App\Http\Middleware;

use Closure;

class IsUser
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
         //Check if the user is super admin
         if(auth()->check()){
             if($request->user()->admin){
 			    return redirect()->back()->withErrors('No tienes los permisos para entrar al sitio solicitado');
 		    }
         }else{
             return redirect()->route('front.login');
         }

         return $next($request);
     }
}
