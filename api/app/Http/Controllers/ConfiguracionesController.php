<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Configuraciones;
use \App\Models\Banner;
use \App\module;


use DB;
use Mail;


use App\Http\Controllers\Controller;
use JWTAuth;

class ConfiguracionesController extends Controller
{


	public function consultarconfiguraciones(Request $request){
        $data = $request->json()->all();
        $datos    = Configuraciones::where('activo', 1)->orderBy('created', 'desc')->get()->toArray();
        $banner_1 = Banner::where('activo', 1)->where('tipo', '1')->get()->toArray();   
        $banner_2 = Banner::where('activo', 1)->where('tipo', '2')->get()->toArray();
        $banner_3 = Banner::where('activo', 1)->where('tipo', '3')->get()->toArray();   
        return response()->json([
            'datos'=>$datos,
            'banner_1'=>$banner_1,
            'banner_2'=>$banner_2,
            'banner_3'=>$banner_3,
            'code'=>200                      
        ],200);
    }//fin function




}