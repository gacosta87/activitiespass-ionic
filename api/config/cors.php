<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Laravel CORS
    |--------------------------------------------------------------------------
    |
    | allowedOrigins, allowedHeaders and allowedMethods can be set to array('*')
    | to accept any value.
    |
    */
   
    'supportsCredentials' => true,
    //'allowedOrigins' => ['https://pwa.mycars.us'],
    'allowedOrigins' => ['*'],
    'allowedHeaders' => ['tokeapp', 'Content-Type', 'tokeinst'],
    'allowedMethods' => ['POST'], // ex: ['GET', 'POST', 'PUT',  'DELETE']
    'exposedHeaders' => ['status'],
    'maxAge' => 0,
];
