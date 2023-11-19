<?php

namespace App\Http\Middleware;

use Closure;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class VerifyAccessKey
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
        // Obtenemos el api-key que el usuario envia
        $key = $request->headers->get('remember_token');
        // Si coincide con el valor almacenado en la aplicacion
        // la aplicacion se sigue ejecutando
        if(isset($key) == env('APP_KEY_2')) {
            return $next($request);
        } else {
            // Si falla devolvemos el mensaje de error
            return response()->json(['msg' => 'No Autorizado', 'Nota'=>'enviame este header'.' '.env('APP_KEY_2')." - token2=".$key ], 200);
        }
    }
}