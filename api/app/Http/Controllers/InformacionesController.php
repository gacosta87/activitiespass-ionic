<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Informaciones;
use \App\module;

use DB;
use Mail;


use App\Http\Controllers\Controller;
use JWTAuth;

class InformacionesController extends Controller
{
    
    public function inforpoliticas(Request $request){
        $data = $request->json()->all();
        $data = Informaciones::where('categoria',$data['categoria'])->first();         
        return response()->json([
            'texto'=>$data->texto,
            'code'=>200                      
        ],200);
    }//fin function

     public function inforcondiciones(Request $request){
        $data = $request->json()->all();
        $data = Informaciones::where('categoria',$data['categoria'])->first();         
        return response()->json([
            'texto'=>$data->texto,
            'code'=>200                      
        ],200);
    }//fin function
 

}//Fin class
