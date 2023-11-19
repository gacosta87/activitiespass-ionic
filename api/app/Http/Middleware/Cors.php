<?php
namespace App\Http\Middleware;
use Closure;
class Cors {
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Headers: *');
        header('Access-Control-Allow-Credentials: false');
        header('content-type: application/json; charset=UTF-8');
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        header("Allow: GET, POST, OPTIONS, PUT, DELETE");
        return $next($request);
        
        //return $next($request)->header('Access-Control-Allow-Credentials','true');
        
       /*$response = $next($request);
       $response->headers->set('Access-Control-Allow-Origin' , '*');
       $response->headers->set('Access-Control-Allow-Methods', 'POST, GET, OPTIONS, PUT, DELETE');
       $response->headers->set('Access-Control-Allow-Headers', '*');*/

        //return $response;
       
       /*return $next($request)
          ->header('Access-Control-Allow-Origin', '*')
          ->header('Access-Control-Allow-Methods', '*')
          ->header('Access-Control-Allow-Headers', '*')
          ->header('Access-Control-Allow-Credentials','true');*/
    }
}
?>