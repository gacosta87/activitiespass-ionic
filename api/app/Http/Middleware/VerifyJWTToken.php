<?php

namespace App\Http\Middleware;

use Closure;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class VerifyJWTToken
{
    
    public function handle($request, Closure $next)
    {
        try{
            if(env('APP_KEY_APP')==$request->headers->get('tokeapp')){
                //return response()->json(['toker'=>$request->headers->get('tokeapp'), 'tokenfail'=>'1']);
            }else{
                return response()->json(['toker'=>$request->headers->get('tokeapp'), 'tokenfail'=>'2']);
            }
        }catch (JWTException $e) {
            if($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
                return response()->json(['error'=>'token vencido', 'tokenfail'=>'1']);
            }else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
                return response()->json(['error'=>'token invalido', 'tokenfail'=>'1']);
            }else{
                return response()->json(['error'=>'Token es requerido', 'tokenfail'=>'1']);
            }
        }
       return $next($request);
    }
}
