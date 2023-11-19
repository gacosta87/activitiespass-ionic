<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
use \App\Models\Puntomensajes;
use \App\module;

use DB;
use Mail;
use DateTime;

use App\Http\Controllers\Basic;
use App\Http\Controllers\Converter;
use App\Http\Controllers\Controller;
use JWTAuth;

class MiperfilController extends Controller
{




public function miperfilfacebooksignin(Request $request){
    $data   = $request->json()->all();

        $datos1 = Mycars::find($data['mycarid']);
        $datos1->toke_facebook        = $data['toke_facebook'];
        $datos1->expiretime_facebook  = $data['expiretime_facebook'];
        $datos1->expirein_facebook    = $data['expirein_facebook'];
        $datos1->user_facebook        = $data['user_facebook'];
        $datos1->activacion_facebook  = 2;
        
        

        $facebook_id_user    = $data['user_facebook'];
        $facebook_token_user = $data['toke_facebook'];

        $headers = [
            'Authorization: Bearer '.$facebook_token_user
        ];

        $url = "https://graph.facebook.com/v17.0/debug_token?input_token=".$facebook_token_user;

        $ch = curl_init();
        curl_setopt( $ch,CURLOPT_URL, $url);
        curl_setopt( $ch,CURLOPT_CUSTOMREQUEST, 'GET',);
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt($ch, CURLOPT_FAILONERROR, TRUE);
        $result = json_decode(curl_exec($ch));
        curl_close( $ch );
        $id_pagina = "";
        $id_pagina_token = "";
        $contar_token = 1;
        
        $token_page[1] = "";
        $token_page[2] = "";
        $token_page[3] = "";

        $page_id[1] = "";
        $page_id[2] = "";
        $page_id[3] = "";

        $page_instagram_id[1] = "";
        $page_instagram_id[2] = "";
        $page_instagram_id[3] = "";

        $page_whatsapp_id[1] = "";
        $page_whatsapp_id[2] = "";
        $page_whatsapp_id[3] = "";


        $page_suscri_id[1] = "";
        $page_suscri_id[2] = "";
        $page_suscri_id[3] = "";


        $toke_bearer = env('TOKEFACEBOOKBEARER');
        
        
        foreach($result->data->granular_scopes as $d){
            //AQUI SUSCRIBO A LA PAGINA
                if($d->scope=="pages_show_list"){
                    $contar_token = 1;
                    foreach($d->target_ids as $x){
                        $page_id[$contar_token] = $x;
                            
                        $headers2 = [
                            'Authorization: Bearer '.$toke_bearer
                        ];
                        $url2 = "https://graph.facebook.com/".$x."?fields=access_token&access_token=".$facebook_token_user;
                        $ch2 = curl_init();
                        curl_setopt( $ch2, CURLOPT_URL, $url2);
                        curl_setopt( $ch2, CURLOPT_CUSTOMREQUEST, 'GET',);
                        curl_setopt( $ch2, CURLOPT_HTTPHEADER, $headers2 );
                        curl_setopt( $ch2, CURLOPT_RETURNTRANSFER, true );
                        curl_setopt( $ch2, CURLOPT_FAILONERROR, TRUE);
                        $result2 = json_decode(curl_exec($ch2));
                        curl_close( $ch2 );
                        $token_page[$contar_token] = $result2->access_token;

                        $headers1 = [
                            'Authorization: Bearer '.$toke_bearer
                        ];
                        $url1 = "https://graph.facebook.com/".$x."/subscribed_apps?subscribed_fields=messages&access_token=".$result2->access_token;
                        $ch1 = curl_init();
                        curl_setopt( $ch1,CURLOPT_URL, $url1);
                        curl_setopt( $ch1,CURLOPT_POST, true );
                        curl_setopt( $ch1,CURLOPT_HTTPHEADER, $headers1 );
                        curl_setopt( $ch1,CURLOPT_RETURNTRANSFER, true );
                        curl_setopt($ch1, CURLOPT_FAILONERROR, TRUE);
                        $result2_1 = json_decode(curl_exec($ch1));
                        $page_suscri_id[$contar_token] = $result2_1->success;
                        curl_close( $ch1 );
                        $contar_token++;
                    }
                }
                 if($d->scope=="instagram_basic"){
                        $contar_token = 1;
                    foreach($d->target_ids as $e){
                        $page_instagram_id[$contar_token] = $e;
                        $contar_token++;
                    }
                }
                if($d->scope=="whatsapp_business_messaging"){
                        $contar_token = 1;
                    foreach($d->target_ids as $f){
                        $page_whatsapp_id[$contar_token] = $f;
                        $contar_token++;
                    }
                }
        }//fin foreach


        $datos1->token_page1        = $token_page[1];
        $datos1->page_id1           = $page_id[1];
        $datos1->page_instagram_id1 = $page_instagram_id[1];
        $datos1->page_whatsapp_id1  = $page_whatsapp_id[1];
        $datos1->page_suscri_id1    = $page_suscri_id[1];

        $datos1->token_page2        = $token_page[2];
        $datos1->page_id2           = $page_id[2];
        $datos1->page_instagram_id2 = $page_instagram_id[2];
        $datos1->page_whatsapp_id2  = $page_whatsapp_id[2];
        $datos1->page_suscri_id2    = $page_suscri_id[2];

        $datos1->token_page3        = $token_page[3];
        $datos1->page_id3           = $page_id[3];
        $datos1->page_instagram_id3 = $page_instagram_id[3];
        $datos1->page_whatsapp_id3  = $page_whatsapp_id[3];
        $datos1->page_suscri_id3    = $page_suscri_id[3];

        $datos1->save();


    return response()->json([
                        'toke_facebook'       => $data['toke_facebook'],
                        'id_pagina'           => $id_pagina,
                        'id_pagina_token'     => $id_pagina_token,
                        'activacion_facebook' => 2,
                        'resultado'           => $result,
                        'code'=>200  
                    ],200);
}



public function miperfilfacebooklogout(Request $request){
    $data   = $request->json()->all();

        $datos1 = Mycars::find($data['mycarid']);
        $datos1->toke_facebook        = "";
        $datos1->activacion_facebook  = 1;
        $datos1->save();

    return response()->json([
                        'activacion_facebook'=>1,
                        'code'=>200  
                    ],200);
}





public function miperfil(Request $request){
        $data   = $request->json()->all();
        $estadisticas = array();
        $estadisticas[0]['count_like']        = 0;
        $estadisticas[0]['count_visitas']     = 0;
        $estadisticas[0]['count_comentarios'] = 0;

        $fecha_actual = date("Y-m-d");
        //sumo 7 día
        $sumardias  =  date("Y-m-d",strtotime($fecha_actual."+ 6 days")); 
        //resto 4 día
        $restardias =  date("Y-m-d",strtotime($fecha_actual."- 4 days")); 
        //sumo 3 meses
        $sumarmeses  =  date("Y-m-d",strtotime($fecha_actual."+ 2 month")); 
        //resto 7 meses
        $restarmeses =  date("Y-m",strtotime($fecha_actual."- 2 month")).'-01'; 


        if($data['page']==1){
                $estadisticas_original  = Valoraciones::where('mycar_id', $data['mycarid'])->where(function ($query){
                                                                                                                        $query->where('tipo', '=', '2')
                                                                                                                              ->orWhere('tipo', '=', '1')
                                                                                                                              ->orWhere('tipo', '=', '8');
                                                                                                                    })->get()->toArray(); 
                $contar_estadistica = 0;
                foreach($estadisticas_original as $esta_ver){

                          if($esta_ver['tipo']==1){ $estadisticas[$contar_estadistica]['count_like']        = !isset($estadisticas[$contar_estadistica]['count_like'])?1:$estadisticas[$contar_estadistica]['count_like']+1;

                    }else if($esta_ver['tipo']==2){ $estadisticas[$contar_estadistica]['count_visitas']     = !isset($estadisticas[$contar_estadistica]['count_visitas'])?1:$estadisticas[$contar_estadistica]['count_visitas']+1;

                    }else if($esta_ver['tipo']==8){ $estadisticas[$contar_estadistica]['count_comentarios'] = !isset($estadisticas[$contar_estadistica]['count_comentarios'])?1:$estadisticas[$contar_estadistica]['count_comentarios']+1;

                    }
                }
                $estadisticas_original_fecha  = Valoraciones::where('mycar_id', $data['mycarid']
                                                                    )->whereBetween('created', [$restardias, $fecha_actual.' 23:59:00']
                                                                    )->where(function ($query){
                                                                                                $query->where('tipo', '=', '2')
                                                                                                      ->orWhere('tipo', '=', '1')
                                                                                                      ->orWhere('tipo', '=', '8');
                                                                                            })->orderBy('created', 'asc')->get()->toArray(); 
                
                $bandera = '';
                $cantidad_fecha_like = array();
                $contar_estadistica2 = -1;
                foreach($estadisticas_original_fecha as $esta_ver2){
                    $esta_ver2['created'] = date("Y-m-d", strtotime($esta_ver2['created']));
                    if($esta_ver2['tipo']==1){ 
                        if($bandera!=$esta_ver2['created']){
                            $bandera = $esta_ver2['created'];
                            $contar_estadistica2++;
                        }
                        $cantidad_fecha_like[$contar_estadistica2]['valor'] = isset($cantidad_fecha_like[$contar_estadistica2]['valor'])?$cantidad_fecha_like[$contar_estadistica2]['valor']+1:1; 
                        $cantidad_fecha_like[$contar_estadistica2]['fecha'] = $esta_ver2['created'];
                    }
                }

                $bandera = '';
                $cantidad_fecha_visitas = array();
                $contar_estadistica3 = -1;
                foreach($estadisticas_original_fecha as $esta_ver2){
                    $esta_ver2['created'] = date("Y-m-d", strtotime($esta_ver2['created']));
                    if($esta_ver2['tipo']==2){ 
                        if($bandera!=$esta_ver2['created']){
                            $bandera = $esta_ver2['created'];
                            $contar_estadistica3++;
                        }
                        $cantidad_fecha_visitas[$contar_estadistica3]['valor'] = isset($cantidad_fecha_visitas[$contar_estadistica3]['valor'])?$cantidad_fecha_visitas[$contar_estadistica3]['valor']+1:1; 
                        $cantidad_fecha_visitas[$contar_estadistica3]['fecha'] = $esta_ver2['created'];
                    }
                }

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
                //foreach ($datos as $key){$contar++;}
                foreach ($datos as $key){
                        $cuentatexto = strlen($key['descripcion']);
                        if($cuentatexto>40){
                            $datos[$contar]['descripcionmas']   = 2;
                        }else{
                            $datos[$contar]['descripcionmas']   = 1;
                        }
                        $datos[$contar]['usuarios'][0]['fechanacimiento2'] = $datos[$contar]['usuarios'][0]['fechanacimiento'];
                        $datos[$contar]['usuarios'][0]['fechanacimiento']  = date('d/m/Y', strtotime($datos[$contar]['usuarios'][0]['fechanacimiento']));

                        /////AQUI VAMOS A ANILIZAR EL COMENTARIO Y LOS @ vaMOS BUSCAR SU ID
                            $variable_a_revisar = $key['descripcion'];
                            preg_match_all('/@([A-Za-z0-9_.]+)/', $variable_a_revisar , $matches);
                            if(isset($matches[0])){
                                foreach($matches[1] as $key){
                                    $c_u  = Usuarios::where('id', $key)->count();
                                    if($c_u!=0){
                                      $d_u  = Usuarios::where('id', $key)->get()->toArray();
                                      $variable_a_revisar = str_replace($key, $d_u[0]['username'], $variable_a_revisar);
                                    }
                                } 
                            }
                            $datos[$contar]['descripcion'] = $variable_a_revisar;
                        ///FIN DE ANALIZAR COMENTARIO///

                        $contar++;
                }
                if($contar==0){ $datos[0] = $array;}
                $servicios = "";
                if(isset($datos[0]['mycartags'])){
                  foreach ($datos[0]['mycartags'] as $key) {
                      $servicios .= $servicios=="#"?$key['denominacion']:" #".$key['denominacion'];
                  }
                }
                $datos2 = Mycarcalificaciones::with('usuarios')->where('mycar_id', $data['mycarid'])->where('activo', 1)->orderBy('created', 'desc')->get();
                //$data2 = Publicaciones::orderBy('created', 'desc')->paginate(15);
                $c1     = Mycarsfavoritos::where('mycar_id', $data['mycarid'])->count();
                $c1_1   = Mycarsfavoritos::where('usuario_id', $data['usuarioid'])->count();
                $c2     = Publicaciones::where('mycar_id', $data['mycarid'])->where('tipo', 2)->count();
                $contar=0;
                $puntaje = 0;
                $califico = 0;
                $favorito = 0;
                foreach ($datos2  as $key) {
                    $contar++;
                    $puntaje = $puntaje + $key['puntaje'];
                }
                if($puntaje!=0){
                    $calificacion = round($puntaje/$contar, 1);
                }else{
                    $calificacion = 0;    
                }
                $datosreservasrealizadas  = Reservas::with('reservausuarios')->with('usuarios')->where('fecha','>=', date('Y-m-d'))->where('reservausuario_id', $data['usuarioid'])->orderBy('fecha', 'asc')->orderBy('hora', 'asc')->get()->toArray();
                $cuentareservas = 0;
                foreach ($datosreservasrealizadas as $key_1) {
                               $datosreservasrealizadas[$cuentareservas]['hora'] = date('h:i a', strtotime($key_1['hora']));
                              //$key_1['usuario_id']
                              $datosconfig = Reservasconfigs::where('usuario_id', $key_1['usuario_id'])->get()->toArray();
                              foreach ($datosconfig as $key) {
                                         if($key_1['turno']==1){
                                        $desde = $key['turno_a_desde'];
                                        $hasta = $key['turno_a_hasta'];
                                    }else if($key_1['turno']==2){
                                        $desde = $key['turno_b_desde'];
                                        $hasta = $key['turno_b_hasta'];
                                    }else if($key_1['turno']==3){
                                        $desde = $key['turno_c_desde'];
                                        $hasta = $key['turno_c_hasta'];
                                    }
                              }
                              $datosreservasrealizadas[$cuentareservas]['desde'] = date('h:i a', strtotime($desde));
                              $datosreservasrealizadas[$cuentareservas]['hasta'] = date('h:i a', strtotime($hasta));
                              $cuentareservas++;
                }
                $datosreservasatender     = Reservas::with('reservausuarios')->with('usuarios')->where('fecha','>=', date('Y-m-d'))->where('usuario_id', $data['usuarioid'])->orderBy('fecha', 'asc')->orderBy('hora', 'asc')->get()->toArray();
                $cuentareservas = 0;
                foreach ($datosreservasatender as $key_1) {
                              $datosreservasatender[$cuentareservas]['hora'] = date('h:i a', strtotime($key_1['hora']));
                              //$key_1['usuario_id']
                              $datosconfig = Reservasconfigs::where('usuario_id', $key_1['usuario_id'])->get()->toArray();
                              foreach ($datosconfig as $key) {
                                         if($key_1['turno']==1){
                                        $desde = $key['turno_a_desde'];
                                        $hasta = $key['turno_a_hasta'];
                                    }else if($key_1['turno']==2){
                                        $desde = $key['turno_b_desde'];
                                        $hasta = $key['turno_b_hasta'];
                                    }else if($key_1['turno']==3){
                                        $desde = $key['turno_c_desde'];
                                        $hasta = $key['turno_c_hasta'];
                                    }
                              }
                              $datosreservasatender[$cuentareservas]['desde'] = date('h:i a', strtotime($desde));
                              $datosreservasatender[$cuentareservas]['hasta'] = date('h:i a', strtotime($hasta));
                              $cuentareservas++;
                }

                $contar_puntos = Puntomensajes::where('usuario_id', $data['usuarioid'])->where('accion', '1')->where('activo', '1')->count();
                $datos4        = Publicaciones::where('mycar_id', $data['mycarid'])->where('tipo', 2)->orderBy('created', 'desc')->paginate(9);
                $contarpromo   = Promociones::where('mycar_id',$data['mycarid'])->whereRaw("TIME_TO_SEC(TIMEDIFF(now(), created)) < 604800")->count();
                return response()->json([
                        'datos'=>$datos,
                        'servicios'=>$servicios,
                        'seguidores'=>$c1,
                        'seguidos'=>$c1_1,
                        'post'=>$c2,
                        'postver'=>$datos4,
                        'calificacion'=>$calificacion,
                        'datos_calificacion'=>$datos2,
                        'datosreservas'       => $datosreservasrealizadas,
                        'datosreservasatender'=> $datosreservasatender,
                        'page'=>$data['page'],
                        'contarpromo'=>$contarpromo,
                        'estadisticas'=>$estadisticas,
                        'cantidad_fecha_like'   =>$cantidad_fecha_like,
                        'cantidad_fecha_visitas'=>$cantidad_fecha_visitas,
                        'contar_puntos'=>$contar_puntos,
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





    public function miperfilsmall(Request $request){
        $data   = $request->json()->all();
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
        foreach ($datos as $key){
                $cuentatexto = strlen($key['descripcion']);
                if($cuentatexto>40){
                    $datos[$contar]['descripcionmas']   = 2;
                }else{
                    $datos[$contar]['descripcionmas']   = 1;
                }
                $datos[$contar]['usuarios'][0]['fechanacimiento2'] = $datos[$contar]['usuarios'][0]['fechanacimiento'];
                $datos[$contar]['usuarios'][0]['fechanacimiento']  = date('d/m/Y', strtotime($datos[$contar]['usuarios'][0]['fechanacimiento']));

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

                $token_page1        = $key['token_page1'];
                $page_id1           = $key['page_id1'];
                $page_instagram_id1 = $key['page_instagram_id1'];
                if($page_id1!=""){
                        $headers2 = [
                           // 'Authorization: Bearer '.$toke_bearer
                        ];
                        $url2 = "https://graph.facebook.com/".$page_id1."?fields=name&access_token=".$token_page1;
                        $ch2 = curl_init();
                        curl_setopt( $ch2, CURLOPT_URL, $url2);
                        curl_setopt( $ch2, CURLOPT_CUSTOMREQUEST, 'GET',);
                        curl_setopt( $ch2, CURLOPT_HTTPHEADER, $headers2 );
                        curl_setopt( $ch2, CURLOPT_RETURNTRANSFER, true );
                        curl_setopt( $ch2, CURLOPT_FAILONERROR, TRUE);
                        $result2 = json_decode(curl_exec($ch2));
                        curl_close( $ch2 );
                        $datos[$contar]['name_page1'] = $result2->name;
                }else{
                        $datos[$contar]['name_page1'] = "";
                }
                if($page_instagram_id1!=""){
                        $headers2 = [
                           // 'Authorization: Bearer '.$toke_bearer
                        ];
                        $url2 = "https://graph.facebook.com/".$page_instagram_id1."?fields=name&access_token=".$token_page1;
                        $ch2 = curl_init();
                        curl_setopt( $ch2, CURLOPT_URL, $url2);
                        curl_setopt( $ch2, CURLOPT_CUSTOMREQUEST, 'GET',);
                        curl_setopt( $ch2, CURLOPT_HTTPHEADER, $headers2 );
                        curl_setopt( $ch2, CURLOPT_RETURNTRANSFER, true );
                        curl_setopt( $ch2, CURLOPT_FAILONERROR, TRUE);
                        $result2 = json_decode(curl_exec($ch2));
                        curl_close( $ch2 );
                        $datos[$contar]['name_instagram1'] = $result2->name;
                }else{
                        $datos[$contar]['name_instagram1'] = "";
                }


                $token_page2        = $key['token_page2'];
                $page_id2           = $key['page_id2'];
                $page_instagram_id2 = $key['page_instagram_id2'];
                if($page_id2!=""){
                        $headers2 = [
                           // 'Authorization: Bearer '.$toke_bearer
                        ];
                        $url2 = "https://graph.facebook.com/".$page_id2."?fields=name&access_token=".$token_page2;
                        $ch2 = curl_init();
                        curl_setopt( $ch2, CURLOPT_URL, $url2);
                        curl_setopt( $ch2, CURLOPT_CUSTOMREQUEST, 'GET',);
                        curl_setopt( $ch2, CURLOPT_HTTPHEADER, $headers2 );
                        curl_setopt( $ch2, CURLOPT_RETURNTRANSFER, true );
                        curl_setopt( $ch2, CURLOPT_FAILONERROR, TRUE);
                        $result2 = json_decode(curl_exec($ch2));
                        curl_close( $ch2 );
                        $datos[$contar]['name_page2'] = $result2->name;
                }else{
                        $datos[$contar]['name_page2'] = "";
                }
                if($page_instagram_id2!=""){
                        $headers2 = [
                           // 'Authorization: Bearer '.$toke_bearer
                        ];
                        $url2 = "https://graph.facebook.com/".$page_instagram_id2."?fields=name&access_token=".$token_page2;
                        $ch2 = curl_init();
                        curl_setopt( $ch2, CURLOPT_URL, $url2);
                        curl_setopt( $ch2, CURLOPT_CUSTOMREQUEST, 'GET',);
                        curl_setopt( $ch2, CURLOPT_HTTPHEADER, $headers2 );
                        curl_setopt( $ch2, CURLOPT_RETURNTRANSFER, true );
                        curl_setopt( $ch2, CURLOPT_FAILONERROR, TRUE);
                        $result2 = json_decode(curl_exec($ch2));
                        curl_close( $ch2 );
                        $datos[$contar]['name_instagram2'] = $result2->name;
                }else{
                        $datos[$contar]['name_instagram2'] = "";
                }



                $token_page3        = $key['token_page3'];
                $page_id3           = $key['page_id3'];
                $page_instagram_id3 = $key['page_instagram_id3'];
                if($page_id3!=""){
                        $headers2 = [
                           // 'Authorization: Bearer '.$toke_bearer
                        ];
                        $url2 = "https://graph.facebook.com/".$page_id3."?fields=name&access_token=".$token_page3;
                        $ch2 = curl_init();
                        curl_setopt( $ch2, CURLOPT_URL, $url2);
                        curl_setopt( $ch2, CURLOPT_CUSTOMREQUEST, 'GET',);
                        curl_setopt( $ch2, CURLOPT_HTTPHEADER, $headers2 );
                        curl_setopt( $ch2, CURLOPT_RETURNTRANSFER, true );
                        curl_setopt( $ch2, CURLOPT_FAILONERROR, TRUE);
                        $result2 = json_decode(curl_exec($ch2));
                        curl_close( $ch2 );
                        $datos[$contar]['name_page3'] = $result2->name;
                }else{
                        $datos[$contar]['name_page3'] = "";
                }
                if($page_instagram_id3!=""){
                        $headers2 = [
                           // 'Authorization: Bearer '.$toke_bearer
                        ];
                        $url2 = "https://graph.facebook.com/".$page_instagram_id3."?fields=name&access_token=".$token_page3;
                        $ch2 = curl_init();
                        curl_setopt( $ch2, CURLOPT_URL, $url2);
                        curl_setopt( $ch2, CURLOPT_CUSTOMREQUEST, 'GET',);
                        curl_setopt( $ch2, CURLOPT_HTTPHEADER, $headers2 );
                        curl_setopt( $ch2, CURLOPT_RETURNTRANSFER, true );
                        curl_setopt( $ch2, CURLOPT_FAILONERROR, TRUE);
                        $result2 = json_decode(curl_exec($ch2));
                        curl_close( $ch2 );
                        $datos[$contar]['name_instagram3'] = $result2->name;
                }else{
                        $datos[$contar]['name_instagram3'] = "";
                }


                $contar++;
        }
        if($contar==0){ $datos[0] = $array;}
      
        return response()->json([
                'datos'=>$datos,
                'code'=>200                      
            ],200);
     
    }




    public function miperfil_usuario(Request $request){
        $data   = $request->json()->all();
        $datos  = Usuarios::where('id', $data['usuarioid'])->get(); 
        return response()->json([
                        'datos'=>$datos,
                        'code'=>200  
                    ],200);
    }


    public function miperfilupdate_delete(Request $request){
        $data = $request->json()->all();
        $code = 201;
        $datos_new= array();
        $code = 200;
        $datos = Mycars::find($data['mycarid']);
        if($data['delete']==1){
                $datos->entrenamiento1 = "";
        }else{
                $datos->entrenamiento2 = "";
        }       
        $datos->save();
        $datos_new  = Usuarios::find($data['usuarioid']);
        $datos_new2 = Mycars::with('usuarios')->with('mycartags')->with('mycartipos')->where('id', $data['mycarid'])->get(); 
        return response()->json([
            'datos' =>$datos_new2,
            'datos2' =>$datos_new2,
            'msg'=>"Disculpe, el nombre de usuario ya existe",
            'code'=>$code                   
        ],200);
    }//fin function





    public function miperfilupdate_asistente(Request $request){
        $data  = $request->json()->all();
        $data2 = $request->all();
        $code = 201;
        $datos_new= array();
        $code = 200;
        $datos = Mycars::find($data['mycarid']);
        $tamano = 0;
        if(isset($data['datos']['produtos_servicios_ofrecidos'])){
                $datos->produtos_servicios_ofrecidos = isset($data['datos']['produtos_servicios_ofrecidos'])?$data['datos']['produtos_servicios_ofrecidos']:$data['datos']['produtos_servicios_ofrecidos'];
                $datos->mision_vision                = isset($data['datos']['mision_vision'])?$data['datos']['mision_vision']:$data['datos']['mision_vision'];
                $datos->fortalezas_debilidades       = isset($data['datos']['fortalezas_debilidades'])?$data['datos']['fortalezas_debilidades']:$data['datos']['fortalezas_debilidades'];
                $datos->comentarios_clientes         = isset($data['datos']['comentarios_clientes'])?$data['datos']['comentarios_clientes']:$data['datos']['comentarios_clientes'];
                $datos->metodos_de_pago              = isset($data['datos']['metodos_de_pago'])?$data['datos']['metodos_de_pago']:$data['datos']['metodos_de_pago'];
                $datos->ubicacion_especifica         = isset($data['datos']['ubicacion_especifica'])?$data['datos']['ubicacion_especifica']:$data['datos']['ubicacion_especifica'];
        }else{


                if(!empty($data['datos']['file1'])){

                        $base64File     = $data['datos']['file1'];
                        $archivo_type   = $data['datos']['file1_type'];
                        $archivo_name   = $data['datos']['file1_name'];
                        $archivo_format = $data['datos']['file1_format'];
                        
                        $base64File_2 = str_replace("data:".$archivo_type.";base64,", "", $base64File);

                        $fileContents = base64_decode($base64File_2);

                        // Genera un nombre único para el archivo y establece la extensión
                        $fileName = uniqid() . $archivo_name; // Cambia la extensión según corresponda

                        $path     = storage_path('documentos')."/".$fileName;
                        $path_url = env('APP_URL_DOCUMENTOS')."/".$fileName;
                        
                        // Guarda el archivo en la ubicación deseada
                        file_put_contents($path, $fileContents);

                        $tamano = filesize($path);
                        if($tamano>5049763 || ($archivo_format!='pdf' && $archivo_format!='doc' && $archivo_format!='docx' && $archivo_format!='txt' )){
                                return response()->json([
                                    'msj'=>"Excuse me, filesize is greater than the allowed 5Mb, also verify that it is the allowed format",
                                    'code'=>201,
                                    'tamano'=>$tamano                   
                                ],200);
                        }

                        $datos->entrenamiento1 = ConverterController::entrenamiento("txt", $path);
                }
                if(!empty($data['datos']['file2'])){
                        
                        $base64File     = $data['datos']['file2'];
                        $archivo_type   = $data['datos']['file2_type'];
                        $archivo_name   = $data['datos']['file2_name'];
                        $archivo_format = $data['datos']['file2_format'];
                        
                        $base64File_2 = str_replace("data:".$archivo_type.";base64,", "", $base64File);

                        $fileContents = base64_decode($base64File_2);

                        // Genera un nombre único para el archivo y establece la extensión
                        $fileName = uniqid() . $archivo_name; // Cambia la extensión según corresponda

                        $path     = storage_path('documentos')."/".$fileName;
                        $path_url = env('APP_URL_DOCUMENTOS')."/".$fileName;
                        
                        // Guarda el archivo en la ubicación deseada
                        file_put_contents($path, $fileContents);

                        $tamano = filesize($path);
                        if($tamano>5049763 || ($archivo_format!='pdf' && $archivo_format!='doc' && $archivo_format!='docx' && $archivo_format!='txt' )){
                                return response()->json([
                                    'msj'=>"Excuse me, filesize is greater than the allowed 5Mb, also verify that it is the allowed format",
                                    'code'=>201,
                                    'tamano'=>$tamano                  
                                ],200);
                        }

                        $datos->entrenamiento2 = ConverterController::entrenamiento("txt", $path);
                }
        }
        $datos->save();
        $datos_new  = Usuarios::find($data['usuarioid']);
       // $datos_new = Mycars::with('usuarios')->with('mycartags')->with('mycartipos')->where('id', $data['mycarid'])->get(); 
        return response()->json([
            'datos' =>$datos_new,
            'msj'=>"Disculpe, el nombre de usuario ya existe",
            'code'=>$code,
            'tamano'=>$tamano                 
        ],200);
    }//fin function

    public function miperfilupdate(Request $request){
        $data = $request->json()->all();
        $result = array();
        if(isset($data['datos']['username'])){
                                //print_r($data);
                                $mycartags = Mycartags::where('mycar_id', $data['mycarid'])->delete();
                                $array     = explode("#", $data['datos']['servicios']);
                                foreach ($array as $key) {
                                    if($key!=""){
                                        $id_user2 =  DB::table('mycartags')->insertGetId(['mycar_id'     => $data['mycarid'],
                                                                                          'denominacion' => trim($key),
                                                                                        ]
                                                                                      );
                                    }
                                }
                                $code = 201;
                                $datos_new= array();
                                $contar_user = Usuarios::where('username', $data['datos']['username'])->where('id', '!=', $data['usuarioid'])->count();
                                if($contar_user==0){
                                                        $code = 200;
                                                        $datos1 = Mycars::find($data['mycarid']);
                                                        if(isset($data['imagenes'][0])){
                                                            $cantidad_caracteres = strlen($data['imagenes'][0]);
                                                            if($cantidad_caracteres>150){
                                                                
                                                                $imgpath1  = storage_path('imagenes')."/".$data['usuarioid'].$data['mycarid'].date('Y-m-d-H-i-s')."_1.webp";
                                                                $imgpath1_ = env('APP_URL_IMAGEN')."/".$data['usuarioid'].$data['mycarid'].date('Y-m-d-H-i-s')."_1.webp";
                                                                $img_reducir1 = $this->reducir($data['imagenes'][0], 700, 700, 80, $imgpath1);
                                                                //$this->base64_to_png($img_reducir1, $imgpath1);

                                                                
                                                                $imgpath2  = storage_path('imagenes')."/".$data['usuarioid'].$data['mycarid'].date('Y-m-d-H-i-s')."_2.webp";
                                                                $imgpath2_ = env('APP_URL_IMAGEN')."/".$data['usuarioid'].$data['mycarid'].date('Y-m-d-H-i-s')."_2.webp";
                                                                $img_reducir2 = $this->reducir($data['imagenes'][0], 170, 170, 80, $imgpath2);
                                                                //$this->base64_to_png($img_reducir2, $imgpath2);

                                                                
                                                                $thumbnail1_  = storage_path('imagenes')."/".$data['usuarioid'].$data['mycarid'].date('Y-m-d-H-i-s')."th_1.webp";
                                                                $thumbnail1   = env('APP_URL_IMAGEN')."/".$data['usuarioid'].$data['mycarid'].date('Y-m-d-H-i-s')."th_1.webp";
                                                                $thum1        = $this->reducir($data['imagenes'][0], 100, 100, 80, $thumbnail1_);
                                                                //$this->base64_to_png($thum1, $thumbnail1_);

                                                                $foto_144_  = storage_path('imagenes')."/".$data['usuarioid'].$data['mycarid'].date('Y-m-d-H-i-s')."th_144.webp";
                                                                $foto_144   = env('APP_URL_IMAGEN')."/".$data['usuarioid'].$data['mycarid'].date('Y-m-d-H-i-s')."th_144.webp";
                                                                $reducir    = $this->reducir($data['imagenes'][0], 170, 170, 80, $foto_144_);

                                                                $foto_35_  = storage_path('imagenes')."/".$data['usuarioid'].$data['mycarid'].date('Y-m-d-H-i-s')."th_35.webp";
                                                                $foto_35   = env('APP_URL_IMAGEN')."/".$data['usuarioid'].$data['mycarid'].date('Y-m-d-H-i-s')."th_35.webp";
                                                                $reducir    = $this->reducir($data['imagenes'][0], 50, 50, 80, $foto_35_);

                                                                $foto_77_  = storage_path('imagenes')."/".$data['usuarioid'].$data['mycarid'].date('Y-m-d-H-i-s')."th_77.webp";
                                                                $foto_77   = env('APP_URL_IMAGEN')."/".$data['usuarioid'].$data['mycarid'].date('Y-m-d-H-i-s')."th_77.webp";
                                                                $reducir    = $this->reducir($data['imagenes'][0], 120, 120, 80, $foto_77_);

                                                                $foto_62_  = storage_path('imagenes')."/".$data['usuarioid'].$data['mycarid'].date('Y-m-d-H-i-s')."th_62.webp";
                                                                $foto_62   = env('APP_URL_IMAGEN')."/".$data['usuarioid'].$data['mycarid'].date('Y-m-d-H-i-s')."th_62.webp";
                                                                $reducir    = $this->reducir($data['imagenes'][0], 100, 100, 80, $foto_62_);
                                                            }else{
                                                                $theme_image_enc_little = "";
                                                                $imgpath1_ = "";
                                                                $imgpath2_ = "";
                                                                $foto_144 = "";
                                                                $foto_35  = "";
                                                                $foto_77  = "";
                                                                $foto_62  = "";
                                                            }
                                                        }else{
                                                            $theme_image_enc_little = "";
                                                            $imgpath1_ = "";
                                                            $imgpath2_ = "";
                                                            $foto_144 = "";
                                                            $foto_35  = "";
                                                            $foto_77  = "";
                                                            $foto_62  = "";
                                                        }
                                                        /////AQUI VAMOS A ANILIZAR EL COMENTARIO Y LOS @ vaMOS BUSCAR SU ID
                                                            $variable_a_revisar = $data['datos']['descripcion'];
                                                            preg_match_all('/@([A-Za-z0-9_.]+)/', $variable_a_revisar , $matches);
                                                            if(isset($matches[0])){
                                                                foreach($matches[1] as $key){
                                                                    $c_u  = Usuarios::where('username', $key)->count();
                                                                    if($c_u!=0){
                                                                      $d_u  = Usuarios::where('username', $key)->get()->toArray();
                                                                      $variable_a_revisar = str_replace($key, $d_u[0]['id'], $variable_a_revisar);
                                                                    }
                                                                } 
                                                            }
                                                            $data['datos']['descripcion'] = $variable_a_revisar;
                                                        ///FIN DE ANALIZAR COMENTARIO///
                                                        $datos1->razon_social  = $data['datos']['razon_social'];
                                                        $datos1->descripcion   = $data['datos']['descripcion'];
                                                        //$datos1->descripcion   = str_replace('\n',  "<br>", $data['datos']['descripcion']);
                                                        $datos1->telefono      = isset($data['datos']['telefono'])?$data['datos']['telefono']:"";
                                                        $datos1->instagram     = isset($data['datos']['instagram'])?$data['datos']['instagram']:"";
                                                        $datos1->facebook      = isset($data['datos']['facebook'])?$data['datos']['facebook']:"";
                                                        $datos1->tiktok        = isset($data['datos']['tiktok'])?$data['datos']['tiktok']:"";
                                                        $datos1->email         = $data['datos']['email'];
                                                        $datos1->latitud       = isset($data['datos']['latitud'])?$data['datos']['latitud']:"0";
                                                        $datos1->longitud      = isset($data['datos']['longitud'])?$data['datos']['longitud']:"0";
                                                        $datos1->categoria_id  = isset($data['datos']['categoria_id'])?$data['datos']['categoria_id']:"1";
                                                        if(isset($data['datos']['ver'])){
                                                          $datos1->ver  = $data['datos']['ver']==false?"1":"2";  
                                                        }

                                                        if(isset($data['datos']['delivery'])){
                                                          $datos1->delivery  = $data['datos']['delivery']==false?"1":"2";  
                                                        }
                                                        /*$datos1->pais          = $data['datos']['pais'];
                                                        $datos1->municipio     = $data['datos']['municipio'];
                                                        $datos1->estado        = $data['datos']['estado'];*/
                                                        $datos1->tag           = isset($data['datos']['servicios'])?$data['datos']['servicios']:"0";
                                                        if($imgpath1_!=""){
                                                            $datos1->foto1         = $imgpath1_;
                                                            $datos1->foto2         = $imgpath2_;
                                                            $datos1->foto_144      = $foto_144;
                                                            $datos1->foto_35       = $foto_35;
                                                            $datos1->foto_77       = $foto_77;
                                                            $datos1->foto_62       = $foto_62;
                                                            $datos1->thumbnail1    = $thumbnail1;
                                                        }
                                                        $datos1->save();        
                                                        $datos = Usuarios::find($data['usuarioid']);
                                                        $datos->username         = $data['datos']['username'];
                                                        $datos->nombre_apellido  = isset($data['datos']['razon_social'])?$data['datos']['razon_social']:"0";
                                                        $datos->tag              = isset($data['datos']['servicios'])?$data['datos']['servicios']:"0";
                                                        
                                                        $brithdate = explode('/', $data['datos']['fechanacimiento']);
                                                        $brithdateFormated = $brithdate[2] . "-" . $brithdate[1] . "-" . $brithdate[0];
                                                        $datos->fechanacimiento  = $brithdateFormated;
                                                        
                                                        if($imgpath1_!=""){
                                                            $datos->foto          = $imgpath1_;
                                                            $datos->foto2         = $imgpath2_;
                                                            $datos->foto_144      = $foto_144;
                                                            $datos->foto_35       = $foto_35;
                                                            $datos->foto_77       = $foto_77;
                                                            $datos->foto_62       = $foto_62;
                                                            $datos1->thumbnail1   = $thumbnail1;
                                                        }
                                                        $datos->save();
                                }
        }else{
            $datos1 = Mycars::find($data['mycarid']);
            $codigo_pais = "";
            $telefono    = "";
            $datos = Usuarios::find($data['usuarioid']);
            if(isset($data['datos']['codigo_pais'])){
                if($data['datos']['codigo_valida']== $datos->codigo_valida_whatsapp){
                        $datos1->codigo_pais = $data['datos']['codigo_pais'];
                        $codigo_pais         = $data['datos']['codigo_pais'];
                        $datos1->telefono    = $data['datos']['telefono'];  
                        $telefono            = $data['datos']['telefono'];   
                }else{
                         return response()->json([
                            'msg'=>"Invalid code",
                            'code'=>201,
                        ],200);
                }
                
            }else{
                $datos1->telefono    = str_replace("+", "", $data['datos']['telefono']);
                $telefono = $datos1->telefono;
            }
            $telefono_whatsapp = $codigo_pais.$telefono;
            $datos->codigo_pais = $datos1->codigo_pais;
            $datos->telefono    = $datos1->telefono;
            $code = 200;
            $headers = [
                'Content-Type: application/json; charset=utf-8;',
                'Authorization: Bearer '.env('TOKEFACEBOOKBEARER') 
            ];
            $data_w = [
                'messaging_product' => "whatsapp",
                'to'   => $telefono_whatsapp,
                "type" => 'template',
                "template"  => array('name'=>'bienvenida_', 'language'=>array('code'=>'en_US')),
            ];

            /*$ch = curl_init();
            curl_setopt( $ch,CURLOPT_URL, 'https://graph.facebook.com/v17.0/104823082639201/messages' );
            curl_setopt( $ch,CURLOPT_POST, true );
            curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
            curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
            curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
            curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $data_w ));
            curl_setopt($ch, CURLOPT_FAILONERROR, TRUE);
            $result = curl_exec($ch);
            curl_close( $ch );*/


            $save_chat_id  =  DB::table('asistentechatsredes')->insertGetId([   'sender_id'     => $telefono_whatsapp,
                                                                                'recipient_id'  => "584144604394",
                                                                                'role'          => 'user',
                                                                                'fields'        => "Whatsapp",
                                                                                'mensaje'       => "Mensaje de template registro",
                                                                                'mensaje_id'    => 0,
                                                                                'created'       => date('Y-m-d H:i:s'),
                                                                                'modified'      => date('Y-m-d H:i:s'),
                                                                                'activo'        => 3,
                                                                                'bandera'       => 1,
                                                                            ]);


            $datos->save();
            $datos1->save();


        }
        $datos_new = Usuarios::find($data['usuarioid']);
        return response()->json([
            'datos' =>$datos_new,
            'msg'=>$result,
            'code'=>$code,
            'resul'=>$result                   
        ],200);
    }//fin function



    public function enviarcodigowhatsapp(Request $request){
        $data = $request->json()->all();
        $code = 200;

        if($data['usuarioid']=="" || $data['usuarioid']==null){

                                return response()->json([
                                    'datos' =>array(),
                                    'resultado' => array(),
                                    'code'=>201,
                                ],200);

        }else{

                                $codigo_verificacion = rand(100000, 999999);
                                if($codigo_verificacion==null || $codigo_verificacion==""){
                                    $codigo_verificacion = rand(100000, 999999);            
                                }
                                $datos1 = Usuarios::find($data['usuarioid']);
                                $datos1->codigo_valida_whatsapp  =  $codigo_verificacion;
                                $datos1->save(); 

                                $datos1 = Mycars::find($data['mycarid']);
                                $codigo_pais = "";
                                $telefono    = "";
                                $datos = Usuarios::find($data['usuarioid']);
                                if(isset($data['datos']['codigo_pais'])){
                                            $codigo_pais  = $data['datos']['codigo_pais'];
                                            $telefono     = $data['datos']['telefono'];   
                                }else{
                                            $telefono    = str_replace("+", "", $data['datos']['telefono']);
                                }
                                $telefono_whatsapp = $codigo_pais.$telefono;
                                $headers = [
                                    'Content-Type: application/json; charset=utf-8;',
                                    'Authorization: Bearer '.env('TOKEFACEBOOKBEARER') 
                                ];
                                $data_w = [
                                    'to'   => $telefono_whatsapp,
                                    "type" => 'text',
                                    "messaging_product"=> "whatsapp",
                                    "recipient_type"=> "individual",
                                    "text"  => array('body'=>"Olympus app sends you a 6-digit code to verify your whatsapp: *".$codigo_verificacion."*")
                                ];

                               /* $data_w = '{
                                                  "recipient_type": "individual",
                                                  "to": "'.$telefono_whatsapp.'",
                                                  "type": "template",
                                                  "messaging_product":"whatsapp",
                                                  "template": {
                                                      "name": "verificacion",
                                                      "language": {
                                                          "code" : "en_US"
                                                      },
                                                      "components":[{
                                                          "type":"body",
                                                          "parameters":[{
                                                              "type":"text",
                                                              "text":"'.$codigo_verificacion.'"
                                                          }]
                                                      }]     
                                                    }
                                }';*/
                                $data_w = '{
                                                "recipient_type": "individual",
                                                "to": "'.$telefono_whatsapp.'",
                                                "type": "text",
                                                "messaging_product":"whatsapp",
                                                "text": {
                                                      "body": "Olympus app sends you a 6-digit code to verify your whatsapp: *'.$codigo_verificacion.'* "
                                                }
                                }';

                                $ch = curl_init();
                                curl_setopt( $ch,CURLOPT_URL, 'https://graph.facebook.com/v17.0/104823082639201/messages' );
                                curl_setopt( $ch,CURLOPT_POST, true );
                                curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
                                curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
                                curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
                                //curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $data_w ));
                                curl_setopt( $ch,CURLOPT_POSTFIELDS, $data_w);
                                curl_setopt($ch, CURLOPT_FAILONERROR, TRUE);
                                $result = curl_exec($ch);
                                curl_close( $ch );

                                $save_chat_id  =  DB::table('asistentechatsredes')->insertGetId([   'sender_id'     => $telefono_whatsapp,
                                                                                                    'recipient_id'  => "584144604394",
                                                                                                    'role'          => 'user',
                                                                                                    'fields'        => "Whatsapp",
                                                                                                    'mensaje'       => "Mensaje de template registro",
                                                                                                    'mensaje_id'    => 0,
                                                                                                    'created'       => date('Y-m-d H:i:s'),
                                                                                                    'modified'      => date('Y-m-d H:i:s'),
                                                                                                    'activo'        => 3,
                                                                                                    'bandera'       => 1,
                                                                                                ]);

                                return response()->json([
                                    'datos' =>$telefono_whatsapp,
                                    'resultado' => $result,
                                    'code'=>$code,
                                ],200);
        }
    }




    public function miperfilupdatemapa(Request $request){
        $data = $request->json()->all();
        $code = 201;
        $datos_new= array();
        $code = 200;
        $datos1 = Mycars::find($data['mycarid']);
        $datos1->latitud       = isset($data['datos']['latitud'])?$data['datos']['latitud']:"0";
        $datos1->longitud      = isset($data['datos']['longitud'])?$data['datos']['longitud']:"0";
        if(isset($data['datos']['ver'])){
          $datos1->ver  = $data['datos']['ver']==false?"1":"2";  
        }
        $datos1->save();        
        $datos_new = Usuarios::find($data['usuarioid']);
        return response()->json([
            'datos' =>$datos_new,
            'msg'=>"Disculpe, el nombre de usuario ya existe",
            'code'=>$code                   
        ],200);
    }//fin function
    public function miperfilfotoupdate(Request $request){
        $data = $request->json()->all();
        $datos1 = Mycars::find($data['mycarid']);
        if(isset($data['imagenes'][0])){
            $cantidad_caracteres = strlen($data['imagenes'][0]);
            if($cantidad_caracteres>150){
                
                $imgpath1  = storage_path('imagenes')."/".$data['usuarioid'].$data['mycarid'].date('Y-m-d-H-i-s')."_1.webp";
                $imgpath1_ = env('APP_URL_IMAGEN')."/".$data['usuarioid'].$data['mycarid'].date('Y-m-d-H-i-s')."_1.webp";
                $img_reducir1 = $this->reducir($data['imagenes'][0], 700, 700, 80, $imgpath1);
                //$this->base64_to_png($img_reducir1, $imgpath1);

                
                $imgpath2  = storage_path('imagenes')."/".$data['usuarioid'].$data['mycarid'].date('Y-m-d-H-i-s')."_2.webp";
                $imgpath2_ = env('APP_URL_IMAGEN')."/".$data['usuarioid'].$data['mycarid'].date('Y-m-d-H-i-s')."_2.webp";
                $img_reducir2 = $this->reducir($data['imagenes'][0], 170, 170, 80, $imgpath2);
                //$this->base64_to_png($img_reducir2, $imgpath2);

                
                $thumbnail1_  = storage_path('imagenes')."/".$data['usuarioid'].$data['mycarid'].date('Y-m-d-H-i-s')."th_1.webp";
                $thumbnail1   = env('APP_URL_IMAGEN')."/".$data['usuarioid'].$data['mycarid'].date('Y-m-d-H-i-s')."th_1.webp";
                $thum1        = $this->reducir($data['imagenes'][0], 100, 100, 80, $thumbnail1_);
                //$this->base64_to_png($thum1, $thumbnail1_);

                $foto_144_  = storage_path('imagenes')."/".$data['usuarioid'].$data['mycarid'].date('Y-m-d-H-i-s')."th_144.webp";
                $foto_144   = env('APP_URL_IMAGEN')."/".$data['usuarioid'].$data['mycarid'].date('Y-m-d-H-i-s')."th_144.webp";
                $reducir    = $this->reducir($data['imagenes'][0], 170, 170, 80, $foto_144_);

                $foto_35_  = storage_path('imagenes')."/".$data['usuarioid'].$data['mycarid'].date('Y-m-d-H-i-s')."th_35.webp";
                $foto_35   = env('APP_URL_IMAGEN')."/".$data['usuarioid'].$data['mycarid'].date('Y-m-d-H-i-s')."th_35.webp";
                $reducir    = $this->reducir($data['imagenes'][0], 50, 50, 80, $foto_35_);

                $foto_77_  = storage_path('imagenes')."/".$data['usuarioid'].$data['mycarid'].date('Y-m-d-H-i-s')."th_77.webp";
                $foto_77   = env('APP_URL_IMAGEN')."/".$data['usuarioid'].$data['mycarid'].date('Y-m-d-H-i-s')."th_77.webp";
                $reducir    = $this->reducir($data['imagenes'][0], 120, 120, 80, $foto_77_);

                $foto_62_  = storage_path('imagenes')."/".$data['usuarioid'].$data['mycarid'].date('Y-m-d-H-i-s')."th_62.webp";
                $foto_62   = env('APP_URL_IMAGEN')."/".$data['usuarioid'].$data['mycarid'].date('Y-m-d-H-i-s')."th_62.webp";
                $reducir    = $this->reducir($data['imagenes'][0], 100, 100, 80, $foto_62_);
            }else{
                $theme_image_enc_little = "";
                $imgpath1_ = "";
                $imgpath2_ = "";
                $foto_144 = "";
                $foto_35  = "";
                $foto_77  = "";
                $foto_62  = "";
            }
        }else{
            $theme_image_enc_little = "";
            $imgpath1_ = "";
            $imgpath2_ = "";
            $foto_144 = "";
            $foto_35  = "";
            $foto_77  = "";
            $foto_62  = "";
        }
        if($imgpath1_!=""){
            $datos1->foto1         = $imgpath1_;
            $datos1->foto2         = $imgpath2_;

            $datos1->foto_144      = $foto_144;
            $datos1->foto_35       = $foto_35;
            $datos1->foto_77       = $foto_77;
            $datos1->foto_62       = $foto_62;

            $datos1->thumbnail1    = $thumbnail1;
        }
        $datos1->save();        
        $datos = Usuarios::find($data['usuarioid']);
        if($imgpath1_!=""){
            $datos->foto             = $imgpath1_;
            $datos->foto2            = $imgpath2_;
            $datos->foto_144         = $foto_144;
            $datos->foto_35          = $foto_35;
            $datos->foto_77          = $foto_77;
            $datos->foto_62          = $foto_62;
            //$datos1->thumbnail1      = $thumbnail1;
        }
        $datos->save();
        $datos_new = Usuarios::find($data['usuarioid']);



        $contar_puntos = Puntomensajes::where('usuario_id', $data['usuarioid'])->where('tipo_punto', '12')->where('activo', '1')->count();
        if($contar_puntos==0){
            $id_punto =  DB::table('puntomensajes')->insertGetId(['usuario_id'  => $data['usuarioid'],
                                                                  'tipo_punto'  => 12,
                                                                  'punto'       => 20,
                                                                  'accion'      => 1,
                                                                  'created'     => date('Y-m-d H:i:s'),
                                                                  'modified'    => date('Y-m-d H:i:s')
                                                              ]);
        }

        return response()->json([
            'datos' =>$datos_new,
            'code'=>200                   
        ],200);
    }//fin function
   

    
    public function reducir($foto="", $WIDTH=350, $HEIGHT=350, $QUALITY=100, $ruta="" ) {
          if($foto!=""){
              $foto2 = str_replace("data:image/jpeg;base64,", "", $foto);
              $theme_image_little    = @imagecreatefromstring(base64_decode($foto2));
              if($theme_image_little !== false) {
                    $org_w = imagesx($theme_image_little);
                    $org_h = imagesy($theme_image_little);
                    $image_little           = imagecreatetruecolor($WIDTH, $HEIGHT);
                    imageinterlace($theme_image_little, true);
                    imageinterlace($image_little, true);
                    imagecopyresampled($image_little, $theme_image_little, 0, 0, 0, 0, $WIDTH, $HEIGHT, $org_w, $org_h);
                    imagewebp($image_little, $ruta, $QUALITY);
              }else{
                 return "";
              }
              return true;
          }else{
              return "";
          }
          //return base64_encode($contents);
    }


    public function base64_to_png( $base64_string, $output_file ) {
          $foto = str_replace("data:image/jpeg;base64,", "", $base64_string);
          $ifp  = fopen( $output_file, "wb" ); 
          fwrite( $ifp, base64_decode( $foto) ); 
          fclose( $ifp ); 
          return($output_file);
    }




}
