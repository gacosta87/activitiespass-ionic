<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    /**  
 	* Indicates whether the XSRF-TOKEN cookie should be set on the response. * * @var bool  
 	*/  
 	protected $addHttpCookie = true;  
    protected $except = [
        'api/*',
        '/*',
        '/checkout/webpay/response',  //Agregar esta línea. Cambiar a tu ruta
        '/checkout/webpay/finish', //Agregar esta línea. Cambiar a tu ruta
    ];
}
