<?php

namespace App\Http\Middleware;

use Closure;
use JWTAuth;
class RolUsuario
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

        $user_rol = JWTAuth::toUser($request->headers->get('token'));

       
        if ($user_rol->rol_id != 5) {
            return response()->json(['error'=>'Accion no Permitida para este rol'],403);
        }

        return $next($request);
    }
}
