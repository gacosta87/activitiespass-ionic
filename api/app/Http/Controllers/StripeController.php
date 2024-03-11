<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Usuarios;
use \App\Models\Mycarclientes;
use \App\Models\Mycarsposts;


use \App\module;


use DB;
use Mail;


use App\Http\Controllers\Controller;
use JWTAuth;

class StripeController extends Controller
{
    

    

    public function precios(Request $request){
        $data = $request->json()->all();

        $precios = DB::select(" 
        SELECT 
            Memberships.id AS Memberships__id, 
            Memberships.name AS Memberships__name, 
            Memberships.profile AS Memberships__profile, 
            Memberships.credit AS Memberships__credit, 
            Memberships.price AS Memberships__price, 
            Memberships.created AS Memberships__created, 
            Memberships.modified AS Memberships__modified, 
            Memberships.show AS Memberships__show 
        FROM 
            memberships Memberships 
        ORDER BY 
            Memberships.name ASC");

        return response()->json([
            'precios'=>$precios,
            'code'=>200                      
        ],200);

    }


}

?>