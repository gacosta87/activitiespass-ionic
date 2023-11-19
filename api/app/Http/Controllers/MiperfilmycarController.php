<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Usuarios;
use \App\Models\Instalacionapp;

use \App\Models\Mycars;
use \App\Models\Mycarcalificaciones;
use \App\Models\Mycarsfavoritos;
use \App\Models\Publicaciones;
use \App\Models\Mycartags;
use \App\Models\Reservas;
use \App\Models\Reservasconfigs;
use \App\Models\Reservasferiados;
use \App\Models\Bloqueos;
use \App\Models\Promociones;
use \App\Models\Valoraciones;
use \App\Models\Paises;

use \App\module;

use DB;
use Mail;
use DateTime;

use App\Http\Controllers\Controller;
use JWTAuth;

class MiperfilmycarController extends Controller
{


 /*
    *   FUNCTION PARA VER EL PERFIL DEL USUARIO
    */
    public function perfilmycar(Request $request){
            $data   = $request->json()->all();
            /*$d_u_1    = Usuarios::where('id', $data['usuariomycarid'])->count();
            $d_u_2    = Usuarios::where('username', $data['usuariomycarid'])->count();
            $d_u_3    = Mycars::where('id', $data['usuariomycarid'])->count();
            
            if($d_u_1!=0){
                $d_u    = Usuarios::where('id', $data['usuariomycarid'])->first()->toArray();    
            }else if($d_u_2!=0){
                $d_u    = Usuarios::where('username', $data['usuariomycarid'])->first()->toArray();
            }else if($d_u_3!=0){
                $d_u['mycar_id'] = $data['usuariomycarid'];
            }else{
                $d_u      = array();
            }
            $d_u2   = $d_u;
            //print_r($d_u2);
            $data['mycarid']        = isset($d_u2['mycar_id'])?$d_u2['mycar_id']:0;
            $data['usuariomycarid'] = isset($d_u2['id'])?$d_u2['id']:0;*/


            $d_u_2    = Usuarios::where('username', $data['usuariomycarid'])->count();
            if($d_u_2!=0){
                $d_u    = Usuarios::where('username', $data['usuariomycarid'])->first()->toArray();
                $d_u2   = $d_u;
                $data['usuariomycarid'] = isset($d_u2['mycar_id'])?$d_u2['mycar_id']:0;
                $data['mycarid'] = $data['usuariomycarid'];    
            }else{
                $data['mycarid'] = $data['usuariomycarid'];    
            }
            
            if($data['page']==1){
                    $datos  = Mycars::with('usuarios')->with('mycartags')->with('mycartipos')->where('id', $data['mycarid'])->get(); 
                    $array  = array('razon_social'  => "",
                                   'rif'           => "",
                                   'descripcion'   => "",
                                   'representante' => "",
                                   'telefono'      => "",
                                   'email'         => "",
                                   'latitud'       => "",
                                   'longitud'      => "",
                                   'pais'          => "",
                                   'municipio'     => "",
                                   'estado'      => "");
                    $contar = 0;
                    $categoria = 0;
                    $usuario_id_mycar = "0";
                    foreach ($datos as $key){
                                            $cuentatexto = strlen($key['descripcion']);
                                            $categoria = $key['categoria_id'];
                                            if($cuentatexto>40){
                                                $datos[$contar]['descripcionmas']   = 2;
                                            }else{
                                                $datos[$contar]['descripcionmas']   = 1;
                                            }
                                            $datos[$contar]['instagram'] = str_replace("@", "", $datos[$contar]['instagram']);
                                            /////AQUI VAMOS A ANILIZAR EL COMENTARIO Y LOS @ vaMOS BUSCAR SU ID
                                                $variable_a_revisar = $key['descripcion'];
                                                preg_match_all('/@([A-Za-z0-9_.]+)/', $variable_a_revisar , $matches);
                                                if(isset($matches[0])){
                                                    foreach($matches[1] as $key2){
                                                        $c_u  = Usuarios::where('id', $key2)->count();
                                                        if($c_u!=0){
                                                          $d_u  = Usuarios::where('id', $key2)->get()->toArray();
                                                          $variable_a_revisar = str_replace($key2, $d_u[0]['username'], $variable_a_revisar);
                                                        }
                                                    } 
                                                }
                                                $datos[$contar]['descripcion'] = $variable_a_revisar;
                                            ///FIN DE ANALIZAR COMENTARIO///
                                            $usuario_id_mycar = $key['usuario_id'];
                                            $contar++;
                    }
                    if($contar==0){ $datos[0] = $array;}
                    $servicios = "";
                    if(isset($datos[0]['mycartags'])){
                      foreach ($datos[0]['mycartags'] as $key) {
                          $servicios .= $servicios=="#"?$key['denominacion']:" #".$key['denominacion'];
                      }
                    }
                    $contarbloqueo1 = Bloqueos::where('usuario_blo_id', $usuario_id_mycar )->where('usuario_id',     $data['usuarioid'])->count();
                    $contarbloqueo2 = Bloqueos::where('usuario_id',     $usuario_id_mycar )->where('usuario_blo_id', $data['usuarioid'])->count();
                    if($contarbloqueo1==0 && $contarbloqueo2==0){
                        $bloqueado_activa = 1;  
                    }else if($contarbloqueo1!=0){
                        $bloqueado_activa = 2; 
                    }else{
                        $bloqueado_activa = 3; 
                    }

                    $datos2 = Mycarcalificaciones::with('usuarios')->where('mycar_id', $data['mycarid'])->where('activo', 1)->orderBy('created', 'desc')->get();
                    $c1     = Mycarsfavoritos::where('mycar_id',    $data['usuariomycarid'])->count();
                    $c1_1   = Mycarsfavoritos::where('usuario_id',  $usuario_id_mycar )->count();
                    if(isset($data['usuarioid'])){                        
                        $c3     = Mycarsfavoritos::where('mycar_id',  $data['mycarid'])->where('usuario_id', $data['usuarioid'])->get();
                    }else{
                        //$c1_1 = 0;
                        $c3 = array();
                    }
                    $id_save =  DB::table('valoraciones')->insertGetId(['mycar_id'    => $data['mycarid'],
                                                                        'usuario_id'  => isset($data['usuarioid'])?$data['usuarioid']:'0',
                                                                        'tipo'        => 2,
                                                                        'puntaje'     => 1,
                                                                        'created'     => date('Y-m-d H:i:s'),
                                                                       ]
                                                                    );
                    $c2     = Publicaciones::where('mycar_id', $data['mycarid'])->where('tipo', 2)->count();
                    $favorito = 0;
                    //echo $data['mycarid']." - ".$data['usuarioid'];
                    foreach ($c3 as $key2) {
                         $favorito++;
                    }
                    $contar=0;
                    $puntaje = 0;
                    $califico = 0;
                    foreach ($datos2  as $key) {
                        $contar++;
                        $puntaje = $puntaje + $key['puntaje'];
                        if($key['usuario_id']==$data['usuarioid']){
                            $califico++;
                        }
                    }
                    if($puntaje!=0){
                        $calificacion = round($puntaje/$contar, 1);
                    }else{
                        $calificacion = 0;    
                    }
                    $datosreservas  = Reservasconfigs::with('usuarios')->where('usuario_id', $usuario_id_mycar)->get()->toArray();
                    $datos4         = Publicaciones::where('mycar_id', $data['mycarid'])->where('tipo', 2)->orderBy('created', 'desc')->paginate(9);
                    $contarpromo    = Promociones::where('mycar_id',$data['usuariomycarid'])->whereRaw("TIME_TO_SEC(TIMEDIFF(now(), created)) < 604800")->count();



                    ///AQUI TENER LOS SEGUIDORES
                        $seguidosArray = array();
                        if(isset($data['sessionactiva']) && $data['sessionactiva']=='true'){
                                $usuario_visitador  = Mycarsfavoritos::where('usuario_id',   $data['usuarioid'])->get();
                                foreach ($usuario_visitador as $key) {
                                        $seguidosArray[]=$key['mycar_id'];
                                }
                                $seguidosArray[]=$key['mycar_id'];
                        }
                    $data_new_users = array();
                    ///FIN AQUI TENER LOS SEGUIDORES
                    if(isset($data['lat']) && $data['lat']!=null && $data['lat']!=0){
                            $data_new_users = Mycars::select('*',
                                                                 DB::raw('( SELECT (acos(sin(radians(latitud)) * sin(radians('.$data['lat'].')) + cos(radians(latitud)) * cos(radians('.$data['lat'].')) *  cos(radians(longitud) - radians('.$data['lon'].'))) * 6378)) as  distanciageolocate')
                                                                )->where('role_id','!=', 1
                                                                )->where('categoria_id', $categoria
                                                                )->whereNotIn('id', $seguidosArray
                                                                )->where('id', "!=", $data['usuariomycarid']
                                                                )->with('usuarios'
                                                                )->inRandomOrder(
                                                                )->orderBy('distanciageolocate', 'asc'
                                                                )->orderBy('created', 'desc'
                                                                )->limit(15)->get()->toArray();

                    }else{
                            $data_new_users = Mycars::select('*'
                                                                )->where('role_id','!=', 1
                                                                )->where('categoria_id', $categoria
                                                                )->whereNotIn('id', $seguidosArray
                                                                )->where('id', "!=", $data['usuariomycarid']
                                                                )->with('usuarios'
                                                                )->inRandomOrder(
                                                                )->orderBy('created', 'desc'
                                                                )->limit(15)->get()->toArray();

                    }
                    $contar_nuew_user = 0;
                    $data_new_users2  = array(); 
                    foreach($data_new_users as $key_new_user){
                        if(isset($key_new_user['usuarios'][0])){
                            $data_new_users2[$contar_nuew_user] = $key_new_user;
                            $contar_nuew_user++;
                        }
                    }
                    $data_new_users = $data_new_users2;
                    return response()->json([
                            'datos'=>$datos,
                            'servicios'=>$servicios,
                            'seguidores'=>$c1,
                            'seguidos'=>$c1_1,
                            'post'=>$c2,
                            'postver'=>$datos4,
                            'calificacion'=>$calificacion,
                            'datos_calificacion'=>$datos2,
                            'califico'=>$califico,
                            'favorito'=>$favorito,
                            'datosreservas'=>$datosreservas,
                            'page'=>$data['page'],
                            'bloqueado'=>$bloqueado_activa,
                            'contarpromo'=>$contarpromo,
                            'mycarid'=>$data['mycarid'],
                            'data_new_users'=>$data_new_users,
                            'code'=>200                      
                        ],200);
            }else{
                    $datos4 = Publicaciones::where('mycar_id', $data['mycarid'])->where('tipo', 2)->orderBy('created', 'desc')->paginate(9);
                    return response()->json([
                            'postver'=>$datos4,
                            'page'=>$data['page'],
                            'code'=>200                      
                        ],200);
            }
    }
    
     public function listapaises(Request $request){
            $data   = $request->json()->all();
            $datos  = Paises::where('activo', 1)->get()->toArray();
            return response()->json([
                'datos'=>$datos,
                'code'=>200                      
            ],200);
    }
    
    public function perfilmycarsfavcalif(Request $request){
            $data = $request->json()->all();
            $d_u    = Usuarios::where('mycar_id', $data['usuariomycarid'])->first();
            $d_u2   = $d_u->toArray();
            $data['mycarid'] = $d_u2['mycar_id'];
            $id_user =  DB::table('mycarcalificaciones')->insertGetId(['mycar_id'    => $data['mycarid'],
                                                                       'usuario_id'  => $data['usuarioid'],
                                                                       'puntaje'     => $data['puntaje'],
                                                                       'descripcion' => $data['descripcion'],
                                                                       'created'     => date('Y-m-d H:i:s')
                                                                      ]
                                                                    );
            $id_save =  DB::table('valoraciones')->insertGetId(['mycar_id'    => $data['mycarid'],
                                                                'usuario_id'  => isset($data['usuarioid'])?$data['usuarioid']:'0',
                                                                'tipo'        => 7,
                                                                'puntaje'     => 1,
                                                                'created'     => date('Y-m-d H:i:s'),
                                                               ]
                                                            );
            return response()->json([
                'code'=>200                      
            ],200);
    }


    public function perfilmycarcompartir(Request $request){
            $data   = $request->json()->all();
            $id_save =  DB::table('valoraciones')->insertGetId(['mycar_id'    => $data['mycarid'],
                                                                'usuario_id'  => isset($data['usuarioid'])?$data['usuarioid']:'0',
                                                                'tipo'        => 3,
                                                                'puntaje'     => 1,
                                                                'created'     => date('Y-m-d H:i:s'),
                                                               ]
                                                            );
            return response()->json([
                'code'=>200                   
            ],200);

    }




}