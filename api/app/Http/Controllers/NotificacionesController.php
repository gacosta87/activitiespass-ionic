<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Mycars;
use \App\Models\Mycarsfavoritos;
use \App\Models\Usuarios;
use \App\Models\Historialpushusuarios;
use \App\module;


use DB;
use Mail;
use DateTime;


use App\Http\Controllers\Controller;
use JWTAuth;

class NotificacionesController extends Controller
{
    
    public function notifilist(Request $request){
        $data = $request->json()->all();
        $datos = Historialpushusuarios::with('usuariolink')->where('usuario_id', $data['usuarioid'])->orderBy('created', 'desc')->paginate(10)->toArray();   
        return response()->json([
            'datos'=>$datos['data'],
            'page'=>$data['page'],
            'code'=>200                      
        ],200);
    }//fin function


    public function mipromocionadd(Request $request){
        $data  = $request->json()->all();
        $code  = 200;
        $time  = "0 H";
        $texto = "";

        //ultimo_msj

        $usua  = Usuarios::where('id', $data['usuarioid'])->get()->toArray();

        $fecha_ultimo_msj = $usua[0]['ultimo_msj']==null?"1900-01-01":$usua[0]['ultimo_msj'];
        $fecha_actual     = date('Y-m-d');
        $horas_esperar    = 360; 

        $fecha1 = new DateTime($fecha_ultimo_msj);
        $fecha2 = new DateTime($fecha_actual);
        $fecha = $fecha1->diff($fecha2);
        $tiempo = "";        
        if($fecha->y>=1 || $fecha->m>=1 || $fecha->d>=15){

                    $segui = Mycarsfavoritos::with('usuarios')->where('mycar_id', $data['mycarid'])->get()->toArray();
                    foreach ($segui as $key) {
                            if($data['mycarid']!=$key['id']){
                                    $usua2 = Usuarios::where('id', $key['usuario_id'])->get()->toArray();
                                    if(isset($usua2[0]['push_token'])){
                                            $push_token = $usua2[0]['push_token'];
                                            $push_platf = $usua2[0]['push_platf'];
                                            $foto2      = $usua[0]['foto2'];
                                            $idio       = $usua2[0]['idioma'];
                                                  if($idio=="es"){
                                                      $titulo = "@".$usua[0]['username'].": tiene un anuncio para ti";
                                            }else if($idio=="en"){
                                                      $titulo = "@".$usua[0]['username'].": has an ad for you";
                                            }else{
                                                      $titulo = "@".$usua[0]['username'].": has an ad for you";
                                            }
                                            if($data['usuarioid']!=$key['usuario_id']){
                                                BasicController::notifpush($push_token, $push_platf, $titulo, $data['texto'], $foto2, 'perfilmycar/'.$usua[0]['mycar_id']);
                                                $id_push =  DB::table('historialpushusuarios')->insertGetId([ 'titulo'            => $data['texto'],
                                                                                                               'texto'            => $titulo,
                                                                                                               'tipo'             => 4,
                                                                                                               'usuariomycar_id'  => $data['usuarioid'],
                                                                                                               'mycar_id'         => $data['mycarid'],
                                                                                                               'usuario_id'       => $key['usuario_id'],
                                                                                                               'created'          => date('Y-m-d H:i:s')
                                                                                                              ]
                                                                                                          );
                                            } 
                                    }
                            }                                                  
                    }
                    $datos2 = Usuarios::find($data['usuarioid']);
                    $datos2->ultimo_msj  = date('Y-m-d');
                    $datos2->save();
        }else{

                    $tiempo .= (15 - $fecha->d);
                    if((15 - $fecha->d) == 1){
                        $tiempo .= " dia";
                    }else{
                        $tiempo .= " dias";
                    }
                    $code = 201;
        }

        return response()->json([
            'code'=>$code,
            'time'=>$tiempo,
            'ver'=>$fecha->h ,
            "fecha1"=>$fecha_ultimo_msj,                      
            "fecha2"=>$fecha_actual,
            "year"=>$fecha->y,
            "mes"=>$fecha->m,
            "dia"=>$fecha->d
        ],200);
    }//fin function

}//Fin class
