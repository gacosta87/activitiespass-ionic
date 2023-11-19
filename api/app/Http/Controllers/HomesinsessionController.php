<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Usuarios;
use \App\Models\Instalacionapp;

use \App\Models\Mycars;
use \App\Models\Mycarcalificaciones;
use \App\Models\Mycarsfavoritos;
use \App\Models\Mycartags;
use \App\Models\Mycarsvaloraciontotal;
use \App\Models\Mensajes;
use \App\Models\Mycarscomentarios;
use \App\Models\Publicacionesver;
use \App\Models\Publicacioneslike;
use \App\Models\Publicaciones;
use \App\Models\Publicacionesgeografica;
use \App\Models\Promociones;

use \App\Models\Reservas;
use \App\Models\Reservasconfigs;
use \App\Models\Reservasferiados;
use \App\Models\Promocionesdist;
use \App\Models\Categorias;
use \App\module;

use DB;
use Mail;

use App\Http\Controllers\Basic;
use App\Http\Controllers\Controller;
use JWTAuth;

class HomesinsessionController extends Controller
{       



public function homesinregistro(Request $request){
            $data = $request->json()->all();
            $data3_aux = array();            
            $data_sin_registro_aux=array();
            $data2_solicitudes = array();
            $data['page']=1;
            if(isset($data['idioma'])){
                $idioma = $data['idioma'];
            }else{
                $idioma = 'es';
            }
            $data_sugerencias = array();
            $data_sugerencias2 = array();
            $data2 = array();
            $data_sin_registro = array();
            if(isset($data['lat']) && $data['lat']!=null){
                               
                                if(!isset($data['idioma'])){
                                    $data1_pro_ = Mycars::select('*',
                                                                 DB::raw('( SELECT (acos(sin(radians(latitud)) * sin(radians('.$data['lat'].')) + cos(radians(latitud)) * cos(radians('.$data['lat'].')) *  cos(radians(longitud) - radians('.$data['lon'].'))) * 6378)) as  distanciageolocate')
                                                                )->where('role_id','!=', 1
                                                                )->with('usuarios'
                                                                )->orderBy('distanciageolocate', 'asc'
                                                                )->orderBy('created', 'desc'                                                                              
                                                                )->limit(15)->get()->toArray();
                                }else{
                                    $data1_pro_ = Categorias::where('activo', 1)->where('idioma', $idioma)->get()->toArray();
                                }

                                //AQUI COMIENZA LA BUSQUEDA DE PUBLICAICONES CERCANAS
                                $data2             = Publicacionesgeografica::with('usuarios'
                                                                                  //)->whereRaw("( tipo=2 or (tipo=1 and (TIME_TO_SEC(TIMEDIFF(now(), created)) < 604800)) )"
                                                                                  )->where("tipo", 2
                                                                                  )->where(
                                                                                        DB::raw('( SELECT (acos(sin(radians(latitud_user)) * sin(radians('.$data['lat'].')) + cos(radians(latitud_user)) * cos(radians('.$data['lat'].')) *  cos(radians(longitud_user) - radians('.$data['lon'].'))) * 6378))'),
                                                                                        "<=",
                                                                                        "15000"
                                                                                  )->orderBy('created', 'desc')->paginate(7);   
            }else{
                                

                                if(!isset($data['idioma'])){
                                    $data1_pro_ = Mycars::select('*'
                                                                )->where('role_id','!=', 1
                                                                )->with('usuarios'
                                                                )->orderBy('created', 'desc'
                                                                )->limit(15)->get()->toArray();
                                }else{
                                    $data1_pro_ = Categorias::where('activo', 1)->where('idioma', $idioma)->get()->toArray();
                                }
                                
                                //AQUI COMIENZA LA BUSQUEDA DE PUBLICAICONES CERCANAS
                                $data2             = Publicacionesgeografica::with('usuarios'
                                                                                  //)->whereRaw("( tipo=2 or (tipo=1 and (TIME_TO_SEC(TIMEDIFF(now(), created)) < 604800)) )"
                                                                                  )->where("tipo", 2
                                                                                  )->orderBy('created', 'desc')->paginate(7);   
            
            }//fin del else que pregunta ubicacion
            $count_promociones = 0;
            $data1_pro_2 = $data1_pro_;
            $data1_pro_  = array();
            foreach ($data1_pro_2 as $key) {
                if(isset($data1_pro_2[$count_promociones]['usuarios'][0])){
                    if(!isset($data['idioma'])){
                            $data1_pro_[$count_promociones] = $key;
                    }else{
                            $data1_pro_[$count_promociones] = $key;
                            $data1_pro_[$count_promociones]['usuarios'][0]['foto2']    = $key['imagen'];
                            $data1_pro_[$count_promociones]['usuarios'][0]['foto_62']  = $key['imagen'];
                            $data1_pro_[$count_promociones]['usuarios'][0]['username'] = $key['denominacion'];
                    }
                    
                    $data1_pro_[$count_promociones]['visto']=1;
                    $count_promociones++;
                }else{
                        if(isset($data['idioma'])){
                            $data1_pro_[$count_promociones] = $key;
                            $data1_pro_[$count_promociones]['usuarios'][0]['foto2']    = $key['imagen'];
                            $data1_pro_[$count_promociones]['usuarios'][0]['foto_62']  = $key['imagen'];
                            $data1_pro_[$count_promociones]['usuarios'][0]['username'] = $key['denominacion'];
                            $data1_pro_[$count_promociones]['visto']=1;
                            $count_promociones++;
                        }
                }
            }
           
            ////////////////AQUI ESTRUCTURAMOS LA PUBLICIDADES//////////////////////
            $data2_aux = $data2->toArray();
            $data3_aux = $data2_aux['data'];
            $contar = 0;
            foreach ($data3_aux as $key) {
                        $id_ver =  DB::table('publicacionesver')->insertGetId(['usuario_id'      => 0,
                                                                               'publicacione_id'  => $key['id'],
                                                                               'created'          => date('Y-m-d H:i:s'),
                                                                              ]
                                                                             );
                        /////AQUI VAMOS A ANILIZAR EL COMENTARIO Y LOS @ vaMOS BUSCAR SU ID
                                $variable_a_revisar = $key['texto'];
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
                                $key_texto = $variable_a_revisar;
                                $data3_aux[$contar]['texto'] = $key_texto;
                                $key['texto']                = $key_texto;
                        ///FIN DE ANALIZAR COMENTARIO///
                        $datoscalificaciones = Mycarcalificaciones::with('usuarios')->where('mycar_id', $key['mycar_id'])->where('activo', 1)->orderBy('created', 'desc')->get();
                        $contarcalificaciones=0;
                        $puntajecalificaciones = 0;
                        $calificacion = 0;  
                        foreach ($datoscalificaciones  as $keycalificacion) {
                            $contarcalificaciones++;
                            $puntajecalificaciones = $puntajecalificaciones + $keycalificacion['puntaje'];
                        }
                        if($puntajecalificaciones!=0){
                            $calificacion = round($puntajecalificaciones/$contarcalificaciones, 1);
                        }
                        $data3_aux[$contar]['calificacion']   = $calificacion;
                        $data3_aux[$contar]['alcance'] = Publicacionesver::where('publicacione_id', $key['id'])->count();
                        $contar1             = Publicacioneslike::where('publicacione_id', $key['id'])->count();
                        $contar2             = 0;
                        $ContarComentaio     = Mycarscomentarios::where('publicacione_id', $key['id'])->count();
                        $ultimoComentaio     = Mycarscomentarios::with('usuarios')->where('publicacione_id', $key['id'])->orderBy('created', 'desc')->limit(1)->get()->toArray();
                        if(!isset($ultimoComentaio[0]['comentario'])){
                            $ultimoComentaio[0]['comentario'] = "";
                            $ultimoComentaio[0]['usuarios']['username'] = "";
                        }else{
                            /////AQUI VAMOS A ANILIZAR EL COMENTARIO Y LOS @ vaMOS BUSCAR SU ID
                                $variable_a_revisar = $ultimoComentaio[0]['comentario'];
                                preg_match_all('/@([A-Za-z0-9_.]+)/', $variable_a_revisar , $matches);
                                if(isset($matches[0])){
                                    foreach($matches[1] as $key3){
                                        $c_u  = Usuarios::where('id', $key3)->count();
                                        if($c_u!=0){
                                          $d_u  = Usuarios::where('id', $key3)->get()->toArray();
                                          $variable_a_revisar = str_replace($key3, $d_u[0]['username'], $variable_a_revisar);
                                        }
                                    } 
                                }
                                $ultimoComentaio[0]['comentario'] = $variable_a_revisar;
                            ///FIN DE ANALIZAR COMENTARIO///
                        }
                        $cuentatextoc = strlen($ultimoComentaio[0]['comentario']);
                        if($cuentatextoc>30){
                          $data3_aux[$contar]['cmas']   = '2';
                          $data3_aux[$contar]['tcomentarios']   = $ultimoComentaio[0]['comentario'];
                        }else{
                          $data3_aux[$contar]['cmas']   = '1';
                          $data3_aux[$contar]['tcomentarios']   = $ultimoComentaio[0]['comentario'];
                        }
                        $data3_aux[$contar]['ucomentarios']   = $ultimoComentaio[0]['usuarios']['username'];
                        $data3_aux[$contar]['ccomentarios']   = $ContarComentaio;
                        $data3_aux[$contar]['cmegusta']   = $contar1;
                        $data3_aux[$contar]['cmegustame'] = $contar2==0?'1':'2';
                        $data3_aux[$contar]['hora']       = date('d/m/Y h:i a', strtotime($key['created']));
                        $cuentatexto = strlen($key['texto']);
                        if($cuentatexto>30){
                            $data3_aux[$contar]['mas']   = '2';
                            $data3_aux[$contar]['textn'] = $key['texto'];
                        }else{
                            $data3_aux[$contar]['mas']   = '1';
                            $data3_aux[$contar]['textn'] = $key['texto'];
                        }
                        if($key['rt_publicacione_id']!="" && $key['rt_publicacione_id']!="NULL" && $key['rt_publicacione_id']!="null"){
                                $data3_aux[$contar]['rtuser'] = Usuarios::where('id', $key['rt_usuario_id'])->orderBy('created', 'desc')->get();
                        }
                        $contar++;
            }//fin FOREACHE PUBLICACIONES
            $contar = 0;
            foreach ($data_sin_registro as $key) {
                if(isset($key["publicaciones"][0])){
                    $data_sin_registro_aux[$contar] =  $key;
                    $contar++;
                }
            }
            return response()->json([
                'code'=>200,
                'data1_pro_'=>$data1_pro_,
                'data2'=>$data3_aux,
                'data_sin_registro'=>$data_sin_registro_aux,
                'data2_solicitudes'=>$data2_solicitudes
            ],200);

        }


public function homesinregistro_para_ti(Request $request){
            $data = $request->json()->all();
            
            return response()->json([
                'code'=>200,
            ],200);
        }



public function homesinregistro_solicitudes(Request $request){
            $data = $request->json()->all();
            return response()->json([
                'code'=>200,
            ],200);
        }


public function home1sinregistro_solicitudes(Request $request){
            $data = $request->json()->all();
            
            return response()->json([
                'code'=>200,
            ],200);

        }





}