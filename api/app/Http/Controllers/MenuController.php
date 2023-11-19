<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Menus;
use \App\Models\Mycars;
use \App\Models\Publicidades;
use \App\Models\Servicioclientes;
use \App\module;


use DB;
use Mail;


use App\Http\Controllers\Controller;
use JWTAuth;

class MenuController extends Controller
{

    
    public function comprobarlocal(Request $request){
        $data = $request->json()->all();
        $contar = Mycars::where('activo', 1)->where('mycar_id', $data['mycarid'])->count();  
        return response()->json([
            'contar'=>$contar,
            'code'=>200                      
        ],200);
    }//fin function
    
    public function listarmenu(Request $request){
        $data = $request->json()->all();
        $datos_menus = Menus::orderBy('orden','ASC')->where('activo', 1)->where('role_id', $data['roleid'])->get();  
        $datos_publi = Publicidades::where('activo', 1)->where('tipo', 1)->get();     
        return response()->json([
            'datos_menus'=>$datos_menus,
            'datos_publi'=>$datos_publi,
            'code'=>200                      
        ],200);
    }//fin function


    public function clientesserviciovial(Request $request){
        $data = $request->json()->all();
        if(isset($data['pais']) && $data['pais']!="" && $data['pais']!="undefined"){
                $datos = Servicioclientes::where('activo', 1)->where('pais', $data['pais'])->get();
        }else{
                $datos = Servicioclientes::where('activo', 1)->get();    
        }
        return response()->json([
            'datos'=>$datos,
            'code'=>200                      
        ],200);
    }//fin function

 
 

}//Fin class
