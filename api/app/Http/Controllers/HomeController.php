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

use \App\Models\Publicacioneslike;
use \App\Models\Publicaciones;
use \App\Models\Publicacionesgeografica;
use \App\Models\Promociones;
use \App\Models\Publicacionesver;
use \App\Models\Reservas;
use \App\Models\Reservasconfigs;
use \App\Models\Reservasferiados;
use \App\Models\Promocionesdist;
use \App\Models\Banner;
use \App\Models\Categorias;
use \App\module;

use DB;
use Mail;

use App\Http\Controllers\Basic;
use App\Http\Controllers\Controller;
use JWTAuth;

class HomeController extends Controller
{       



        public function home(Request $request){
            $data = $request->json()->all();
            $data2_solicitudes = array();
            $contarseguidores = 0;
            $data_sugerencias = array();
            $data_sugerencias2 = array();
            $data1_pro_lista = array();
            if(isset($data['idioma'])){
                $idioma = $data['idioma'];
            }else{
                $idioma = 'es';
            }
            if(isset($data['usuarioid'])){
                $mensajes =  Mensajes::where('usuarioid_desty',$data['usuarioid'])->where('status',1)->count();  
            }else{
                $mensajes = 0;
            }
            $data['pais'] = "";
            ///AQUI TENER LOS SEGUIDORES
                $seguidosArray  = array();
                $seguidosArray2 = array();
                $usuarioid = $data['usuarioid'];
                if($data['sessionactiva']=='true'){
                        $c1     = Mycarsfavoritos::where('usuario_id',   $data['usuarioid'])->get();
                        $contarseguidores = 0;
                        foreach ($c1 as $key) {
                                $contarseguidores++;
                                $seguidosArray[]                  = $key['mycar_id'];
                                $seguidosArray2[$key['mycar_id']] = $key['mycar_id'];
                        }
                }else{
                    $usuarioid = 0;
                }
            $data_new_users = array();
            ///FIN AQUI TENER LOS SEGUIDORES
            $data1_pro_ = array();
            if($data['page']==1){
                                    $user = $data['usuarioid'];
                                    $data1_pro_lista = array(); 
                                    if(isset($data['lat']) && $data['lat']!=null && $data['lat']!=0){
                                                                    //ESTA SECCION TRAE LAS PROMOCIONES CUANDO UNO ENVIE EL USUARIO

                                                                if(!isset($data['idioma'])){
                                                                    $data1_pro_ = Mycars::select('*',
                                                                                                 DB::raw('( SELECT (acos(sin(radians(latitud)) * sin(radians('.$data['lat'].')) + cos(radians(latitud)) * cos(radians('.$data['lat'].')) *  cos(radians(longitud) - radians('.$data['lon'].'))) * 6378)) as  distanciageolocate')
                                                                                                )->where('role_id','!=', 1
                                                                                                )->where('usuario_id', "!=", $data['usuarioid']
                                                                                                )->with('usuarios'
                                                                                                )->orderBy('distanciageolocate', 'desc'
                                                                                                )->inRandomOrder(
                                                                                                )->limit(15)->get()->toArray();
                                                                }else{
                                                                    $data1_pro_ = Categorias::where('activo', 1)->where('idioma', $idioma)->get()->toArray();
                                                                }

                                                                    $data_new_users = Mycars::select('*',
                                                                                                         DB::raw('( SELECT (acos(sin(radians(latitud)) * sin(radians('.$data['lat'].')) + cos(radians(latitud)) * cos(radians('.$data['lat'].')) *  cos(radians(longitud) - radians('.$data['lon'].'))) * 6378)) as  distanciageolocate')
                                                                                                        )->where('role_id','!=', 1
                                                                                                        )->whereNotIn('id', $seguidosArray
                                                                                                        )->where('usuario_id', "!=", $data['usuarioid']
                                                                                                        )->with('usuarios'
                                                                                                        )->orderBy('distanciageolocate', 'asc'
                                                                                                        )->orderBy('created', 'desc'                                                                              
                                                                                                        )->limit(15)->get()->toArray();
                                                                  
                                    }else{                          
                                                                if(!isset($data['idioma'])){
                                                                    $data1_pro_ = Mycars::select('*'
                                                                                            )->where('role_id','!=', 1
                                                                                            )->with('usuarios'
                                                                                            )->inRandomOrder(
                                                                                            )->limit(15)->get()->toArray();
                                                                }else{
                                                                    $data1_pro_ = Categorias::where('activo', 1)->where('idioma', $idioma)->get()->toArray();
                                                                }

                                                                    $data_new_users = Mycars::select('*'
                                                                                                    )->where('role_id','!=', 1
                                                                                                    )->whereNotIn('id', $seguidosArray
                                                                                                    )->with('usuarios'
                                                                                                    )->orderBy('created', 'desc'
                                                                                                    )->limit(15)->get()->toArray();
                                    }//fin de else
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
                                      
            }else{
                                    $data1 = array();
                                    $data1_pro_ = array();
                                    $data1_pro_lista = array();
            }
            if($data['page']==1){
                $cantidaddepublici   = 3;
                $cantidaddesugeridos = 4;
            }else{
                $cantidaddepublici   = 6;
                $cantidaddesugeridos = 1;
            }
            $data_sin_registro  = array();
            if($data['sessionactiva']=='true'){
                            $datos_usuarios =  Usuarios::with('mycars')->where('id',$data['usuarioid'])->get()->toArray(); 
                            /*$CoProUsu       = Promociones::where('usuario_id',$data['usuarioid'])->whereRaw("TIME_TO_SEC(TIMEDIFF(now(), created)) < 604800")->count();
                            $datos_usuarios[0]["cpu"] = $CoProUsu;
                            if($CoProUsu!=0){
                                $CoProUsudata = Promociones::where('usuario_id',$data['usuarioid'])->whereRaw("TIME_TO_SEC(TIMEDIFF(now(), created)) < 604800")->limit(1)->orderBy('created', 'asc')->get()->toArray();
                                $datos_usuarios[0]["promocionid1"] = $CoProUsudata[0]['id'];    
                            } */                           
                            /////////AQUI AGREGO PERFILES CERCANOS
                            $data_sin_registro_aux=array();                            
                            /////////////////////////////////AQUI PREGunTA SI TIENE SEGUIDORES
                            if($contarseguidores==0){
                                            $contar_sin_registro = 0;
                                            if(isset($data['lat']) && $data['lat']!=null){
                                                        //AQUI COMIENZA LA BUSQUEDA DE PUBLICAICONES CERCANAS CON LATITUDES
                                                        $data2 = Publicacionesgeografica::with('usuarios'
                                                                                                //)->whereRaw("( tipo=2 or (tipo=1 and (TIME_TO_SEC(TIMEDIFF(now(), created)) < 604800)) )"
                                                                                                )->where("tipo", 2
                                                                                                )->where(
                                                                                                        DB::raw('( SELECT (acos(sin(radians(latitud_user)) * sin(radians('.$data['lat'].')) + cos(radians(latitud_user)) * cos(radians('.$data['lat'].')) *  cos(radians(longitud_user) - radians('.$data['lon'].'))) * 6378))'),
                                                                                                        "<=",
                                                                                                        "15000"
                                                                                                )->orWhere('usuario_id', $usuarioid
                                                                                                )->orderBy('created', 'desc')->paginate($cantidaddepublici)->toArray();  
                                            }else{
                                                        //AQUI COMIENZA LA BUSQUEDA DE PUBLICAICONES CERCANAS
                                                        $data2 = Publicacionesgeografica::with('usuarios'
                                                                                              //)->whereRaw("( tipo=2 or (tipo=1 and (TIME_TO_SEC(TIMEDIFF(now(), created)) < 604800)) )"
                                                                                              )->where("tipo", 2
                                                                                              )->orWhere('usuario_id', $usuarioid
                                                                                              )->orderBy('created', 'desc')->paginate($cantidaddepublici)->toArray();  
                                            }//fIN ELSE
                                            foreach ($data_sin_registro as $key) {
                                                if(isset($key["publicaciones"][0])){
                                                    $data_sin_registro_aux[$contar_sin_registro] =  $key;
                                                    $contar_sin_registro++;
                                                }
                                            }
                                            
                            }else{//AQUI SI TIENE SEGUIDPRES
                                            $data2 = Publicaciones::with('usuarios'
                                                                         )->where(function($query) use ($seguidosArray, $usuarioid){
                                                                            $query->whereIn('mycar_id', $seguidosArray)->orWhere('usuario_id', $usuarioid);
                                                                        }
                                                                        //)->whereRaw("( tipo=2 or (tipo=1 and (TIME_TO_SEC(TIMEDIFF(now(), created)) < 604800)) )"
                                                                        )->where("tipo", 2
                                                                        )->orderBy('created', 'desc')->paginate($cantidaddepublici)->toArray();   
                            }//AQUI ES EL ELSE DE QUE SI TIENE SEGUIDORES
                            if(count($data2)<=0){
                                            if(isset($data['lat']) && $data['lat']!=null){
                                                $data2 = Publicacionesgeografica::with('usuarios'
                                                                                      //)->whereRaw("( tipo=2 or (tipo=1 and (TIME_TO_SEC(TIMEDIFF(now(), created)) < 604800)) )"
                                                                                      )->where("tipo", 2
                                                                                      )->where(
                                                                                                DB::raw('( SELECT (acos(sin(radians(latitud_user)) * sin(radians('.$data['lat'].')) + cos(radians(latitud_user)) * cos(radians('.$data['lat'].')) *  cos(radians(longitud_user) - radians('.$data['lon'].'))) * 6378))'),
                                                                                                "<=",
                                                                                                "15000"
                                                                                      )->orWhere('usuario_id', $usuarioid
                                                                                      )->orderBy('created', 'desc'
                                                                                      )->inRandomOrder(
                                                                                      )->paginate($cantidaddepublici)->toArray();  
                                            }else{
                                                $data2 = Publicacionesgeografica::with('usuarios'
                                                                                      //)->whereRaw("( tipo=2 or (tipo=1 and (TIME_TO_SEC(TIMEDIFF(now(), created)) < 604800)) )"
                                                                                      )->where("tipo", 2
                                                                                      )->orWhere('usuario_id', $usuarioid
                                                                                      )->orderBy('created', 'desc'
                                                                                      )->inRandomOrder(
                                                                                      )->paginate($cantidaddepublici)->toArray();  
                                            }//fin else
                            }//FIN DE CONTAR CSI TIENE DATOS DE PUBLICIDAD


                            

                            ///AQUII MUESTO SUGERENCIAS a LOS USUARIOS ALEATORIA
                            $mes_anterior = date('Y-m', strtotime('-3 month'))."-01";
                            if(isset($data['lat']) && $data['lat']!=null){
                                $data_sugerencias = Publicacionesgeografica::with('usuarios'
                                                                                          //)->whereRaw("( tipo=2 or (tipo=1 and (TIME_TO_SEC(TIMEDIFF(now(), created)) < 604800)) )"
                                                                                          )->where("tipo", 2
                                                                                          )->where(
                                                                                                    DB::raw('( SELECT (acos(sin(radians(latitud_user)) * sin(radians('.$data['lat'].')) + cos(radians(latitud_user)) * cos(radians('.$data['lat'].')) *  cos(radians(longitud_user) - radians('.$data['lon'].'))) * 6378))'),
                                                                                                    "<=",
                                                                                                    "15000"
                                                                                          )->Where('usuario_id', "!=", $usuarioid
                                                                                          )->whereNotIn('mycar_id', $seguidosArray
                                                                                          )->where('created', ">=" ,$mes_anterior
                                                                                          )->inRandomOrder(
                                                                                          )->limit($cantidaddesugeridos
                                                                                          )->get()->toArray();  
                            }else{
                                $data_sugerencias = Publicacionesgeografica::with('usuarios'
                                                                                          //)->whereRaw("( tipo=2 or (tipo=1 and (TIME_TO_SEC(TIMEDIFF(now(), created)) < 604800)) )"
                                                                                          )->where("tipo", 2
                                                                                          )->Where('usuario_id', "!=", $usuarioid
                                                                                          )->whereNotIn('mycar_id', $seguidosArray
                                                                                          )->where('created', ">=" ,$mes_anterior
                                                                                          )->inRandomOrder(
                                                                                          )->limit($cantidaddesugeridos
                                                                                          )->get()->toArray();  
                            }//fin else
                            if($data['page']!=1){
                                                    $contar_sugerencia  = 0;
                                                    foreach($data_sugerencias as $key_sugerencia){
                                                        $data_sugerencias2[$contar_sugerencia] = $key_sugerencia;
                                                        $data_sugerencias2[$contar_sugerencia]['nosigo'] = 2;
                                                        $contar_sugerencia++;
                                                    }
                                                    foreach ($data2['data'] as $key) {
                                                        $data_sugerencias2[$contar_sugerencia]=$key;
                                                        $data_sugerencias2[$contar_sugerencia]['nosigo'] = 1;
                                                        $contar_sugerencia++;
                                                    }
                            }else{
                                                    $data_sugerencias2  = array();
                                                    $contar_sugerencia  = 0;
                                                    $contar_sugerencia2 = 0;
                                                    if (count($data_sugerencias)>0) {
                                                        foreach($data_sugerencias as $key_sugerencia){
                                                            $data_sugerencias2[$contar_sugerencia] = $key_sugerencia;
                                                            $data_sugerencias2[$contar_sugerencia]['nosigo'] = 2;
                                                            $contar_sugerencia++;
                                                            if(isset($data2['data'][$contar_sugerencia2])){
                                                                $data_sugerencias2[$contar_sugerencia]           = $data2['data'][$contar_sugerencia2];
                                                                $data_sugerencias2[$contar_sugerencia]['nosigo'] = 1;
                                                                $contar_sugerencia++;
                                                                $contar_sugerencia2++;
                                                            }
                                                        }
                                                    }else{
                                                        foreach ($data2['data'] as $key) {
                                                            $data_sugerencias2[$contar_sugerencia]=$key;
                                                            $data_sugerencias2[$contar_sugerencia]['nosigo'] = 1;
                                                            $contar_sugerencia++;
                                                        }
                                                    }
                                                    
                            }
                            ///FIN AQUII MUESTO SUGERENCIAS a LOS USUARIOS ALEATORIA
                            $data3_aux = $data_sugerencias2;
                            //$data3_aux = $data2['data'];
                            $contar = 0;
                            foreach ($data3_aux as $key) {
                                        $id_ver =  DB::table('publicacionesver')->insertGetId(['usuario_id'       => $data['usuarioid'],
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
                                        $data3_aux[$contar]['calificacion']   = 0;
                                        $data3_aux[$contar]['alcance'] = Publicacionesver::where('publicacione_id', $key['id'])->count();
                                        $contar1             = Publicacioneslike::where('publicacione_id', $key['id'])->count();
                                        $contar2             = Publicacioneslike::where('usuario_id', $data['usuarioid'])->where('publicacione_id', $key['id'])->count();
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
                                                $data3_aux[$contar]['cmas']   = 2;
                                                $data3_aux[$contar]['tcomentarios']   = $ultimoComentaio[0]['comentario'];
                                        }else{
                                                $data3_aux[$contar]['cmas']   = 1;
                                                $data3_aux[$contar]['tcomentarios']   = $ultimoComentaio[0]['comentario'];
                                        }
                                        $data3_aux[$contar]['ucomentarios']   = $ultimoComentaio[0]['usuarios']['username'];
                                        $data3_aux[$contar]['ccomentarios']   = $ContarComentaio;
                                        $data3_aux[$contar]['cmegusta']   = $contar1;
                                        $data3_aux[$contar]['cmegustame'] = $contar2==0?'1':'2';
                                        $data3_aux[$contar]['hora']       = date('d/m/Y h:i a', strtotime($key['created']));
                                        $cuentatexto = strlen($key['texto']);
                                        if($cuentatexto>30){
                                                $data3_aux[$contar]['mas']   = 2;
                                                $data3_aux[$contar]['textn'] = $key['texto'];
                                        }else{
                                                $data3_aux[$contar]['mas']   = 1;
                                                $data3_aux[$contar]['textn'] = $key['texto'];
                                        }
                                        if($key['rt_publicacione_id']!="" && $key['rt_publicacione_id']!="NULL" && $key['rt_publicacione_id']!="null"){
                                                $data3_aux[$contar]['rtuser'] = Usuarios::where('id', $key['rt_usuario_id'])->orderBy('created', 'desc')->get();
                                        }

                                        if($data3_aux[$contar]['usuarios']=="NULL" || $data3_aux[$contar]['usuarios']=="null" || $data3_aux[$contar]['usuarios']==""){
                                                $data3_aux[$contar]['usuarios'] = Usuarios::where('mycar_id', $key['id'])->orderBy('created', 'desc')->get()->toArray();  
                                        }
                                        $contar++;
                            }//FIN FOREACHE
                           
            }//fin else
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
                'code'=>200,
                'page'=>$data['page'],
                'data2'=>$data3_aux,
                'mensajes'=> $mensajes,
                'datos_usuarios'=>$datos_usuarios,
                'data1_pro_'=>$data1_pro_,
                'data1_pro_lista'=>$data1_pro_lista,
                'data_sin_registro'=>$data_sin_registro_aux,
                'contarseguidores'=>$contarseguidores,
                'data_new_users'=>$data_new_users,
                'data_sugerencias'=>$data_sugerencias,
                'meses_anteriores'=>$mes_anterior,
                'data2_solicitudes'=>$data2_solicitudes,
                'msg'=>'Bienvenido'                         
            ],200);

        }



        public function home_para_ti(Request $request){
            $data = $request->json()->all();
      
            return response()->json([
                'code'=>200,
            ],200);
        }

        public function home_solicitudes(Request $request){
            $data = $request->json()->all();
     
            return response()->json([
                'code'=>200,
                'data2_solicitudes'=>$data2_solicitudes
            ],200);
        }

        public function home1_solicitudes(Request $request){
            $data = $request->json()->all();
            return response()->json([

                'msg'=>'Bienvenido'                         
            ],200);

        }












        



        
        /*
        *  Comprueba si hay mensajes nuevos
        */
        public function comprobarmensajes(Request $request){
            $data = $request->json()->all();
            //estado
            //pais
            //municipio
            if(isset($data['usuarioid'])){
                $mensajes =  Mensajes::where('usuarioid_desty',$data['usuarioid'])->where('status',1)->count();   
            }else{
                $mensajes = 0;
            }
            return response()->json([
                'code'=>200,
                'mensajes'=> $mensajes,
                'msg'=>'Bienvenido'                         
            ],200);

        }
        /*
        *       Buscar data perfil compartir
        */
        public function publicaciondata(Request $request){
            $data  = $request->json()->all();
            $datos =  Usuarios::where('id',$data['usuarioid'])->get()->toArray(); 
            $datos2 =  Publicaciones::where('id',$data['publiid'])->get()->toArray(); 
            return response()->json([
                'code'=>200,
                'datos'=> $datos,
                'datos2'=> $datos2,
                'msg'=>'Bienvenido'                         
            ],200);
        }
        /*
        *       Buscar data perfil compartir
        */
        public function perfildata(Request $request){
            $data  = $request->json()->all();
            $datos =  Usuarios::where('id',$data['usuarioid'])->get()->toArray(); 
            return response()->json([
                'code'=>200,
                'datos'=> $datos,
                'msg'=>'Bienvenido'                         
            ],200);
        }
        public function convert_to_utf8_recursively($dat){
                      if( is_string($dat) ){
                         return mb_convert_encoding($dat, 'UTF-8', 'UTF-8');
                      }
                      elseif( is_array($dat) ){
                         $ret = [];
                         foreach($dat as $i => $d){
                           $ret[$i] = convert_to_utf8_recursively($d);
                         }
                         return $ret;
                      }
                      else{
                         return $dat;
                      }
         }

}
?>