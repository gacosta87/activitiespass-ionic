<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Usuarios;
use \App\Models\Instalacionapp;

use \App\Models\Mycars;
use \App\Models\Mycarcalificaciones;
use \App\Models\Mycarsfavoritos;
use \App\Models\Mycartags;
use \App\Models\Mycarscomentarios;

use \App\Models\Puntomensajes;

use \App\Models\Publicaciones;
use \App\Models\Publicacioneslike;
use \App\module;

use DB;
use Mail;

use App\Http\Controllers\Basic;
use App\Http\Controllers\Controller;
use JWTAuth;

class CompartirController extends Controller
{
   		public function saludar(Request $request){
   				$id= request()->get('id');
		   		return response()->json([
		   			'saludar'=>$id,
			             'code'=>200                   
			        ],200);
   		}



		public function compartirpromocionate(Request $request){
        	$data  = $request->json()->all();
        	$datos = Publicaciones::with('usuarios')->where('id', $data['publicid'])->orderBy('created', 'desc')->get()->toArray();  
        	foreach($datos as $ve){
        			if($ve['tipo']==1){
        				$tipo = 3;
        			}else{
        				$tipo = 2;
        			}
		        	$id_user =  DB::table('promociones')->insertGetId(['usuario_id'  => $data['usuarioid'],
			                                                           'mycar_id'    => $data['mycarid'],
			                                                           'ruta_video'  => '',
			                                                           'ruta_mini'   => '',
			                                                           'ruta_imagen' => $ve['imagen1'],
			                                                           'ruta_imagen2'=> $ve['imagen1_m'],
			                                                           'texto'       => '',
			                                                           'latitud'     => $data['lat'],
			                                                           'longitud'    => $data['lon'],
			                                                           'created'     => date('Y-m-d H:i:s'),
			                                                           'tipo'        => $tipo,
			                                                           'modified'    => date('Y-m-d H:i:s'),
			                                                           'rt_publicacione_id' => $ve['id'],
			                                                           'rt_usuario_id'      => $ve['usuario_id'],
			                                                           'rt_mycarid'         => $ve['mycar_id'],
			                                                           'rt_text'            => $ve['texto']
			                                                          ]);
		        	$data['mycarid'] = $ve['mycar_id'];
		    }//fin foreachr
		    $usua  = Usuarios::where('id',       $data['usuarioid'])->get()->toArray();
	        $usua2 = Usuarios::where('mycar_id', $data['mycarid'])->get()->toArray();
	        $push_token = !empty($usua2[0]['push_token'])?$usua2[0]['push_token']:0;
	        $push_platf = !empty($usua2[0]['push_platf'])?$usua2[0]['push_platf']:0;
	        $foto2      = $usua[0]['foto2'];
	        $idio       = $usua2[0]['idioma'];
	                if($idio=="es"){
	                    $titulo  = "Olympus app";
	                    $mensaje = "@".$usua[0]['username'].": Compartio tu publicación en sus promocionate";
	        }else if($idio=="en"){
	                    $titulo  = "Olympus app";
	                    $mensaje = "@".$usua[0]['username'].": Shared your post in their promote yourself";
	        }else{
	                    $titulo  = "Olympus app";
	                    $mensaje = "@".$usua[0]['username'].": Shared your post in their promote yourself";
	        }
            if($usua[0]['id']!=$usua2[0]['id']){       
                  BasicController::notifpush($push_token, $push_platf, $titulo, $mensaje, $foto2, 'perfilpostverall/'.$data['publicid'].'/'.$data['usuarioid']);
                  $id_push =  DB::table('historialpushusuarios')->insertGetId(['titulo' => $titulo,
                                                                               'texto'  => $mensaje,
                                                                               'tipo'   => 5,//el 4 es compartir promocionate
                                                                               'usuariomycar_id' => $usua[0]['id'],
                                                                               'mycar_id'        => $usua[0]['mycar_id'],
                                                                               'usuario_id'      => $usua2[0]['id'],
                                                                               'publicacione_id' => $data['publicid'],
                                                                               'created'     => date('Y-m-d H:i:s')
                                                                              ]
                                                                          );
            }

            $contar_puntos = Puntomensajes::where('usuario_id', $data['usuarioid'])->whereRaw("DATE(created) = '".date('Y-m-d')."'")->where('activo', '1')->count();
            if($contar_puntos<50){
                $id_punto =  DB::table('puntomensajes')->insertGetId(['usuario_id'  => $data['usuarioid'],
                                                                      'tipo_punto'  => 4,
                                                                      'punto'       => 25,
                                                                      'accion'      => 1,
                                                                      'created'     => date('Y-m-d H:i:s'),
                                                                      'modified'    => date('Y-m-d H:i:s')
                                                                  ]);
            }
        	return response()->json([
	                'code'=>200                   
	        ],200);
        }



        public function compartirperfil(Request $request){
        	$data  = $request->json()->all();
        	$datos      = Publicaciones::with('usuarios')->where('id', $data['publicid'])->orderBy('created', 'desc')->get()->toArray();  
        	$registroid = md5($data['usuarioid']).md5($data['mycarid']).md5(date('m-Y-d H:i:s a'));
        	foreach($datos as $ve){
		        	$id_publ =  DB::table('publicaciones')->insertGetId([  'usuario_id'    => $data['usuarioid'],
			                                                               'mycar_id'      => $data['mycarid'],
			                                                               'texto'         => $ve['texto'],
			                                                               'publicartipo'  => $ve['publicartipo'],
			                                                               'titulo'        => $ve['titulo'],
			                                                               'precio'        => $ve['precio'],
			                                                               'precio_oferta' => $ve['precio_oferta'],
			                                                               'isomoneda'     => $ve['isomoneda'],
			                                                               'imagen1'       => $ve['imagen1'],
			                                                               'imagen1_m'     => $ve['imagen1_m'],
			                                                               'imagen2'       => $ve['imagen2'],
			                                                               'imagen3'       => $ve['imagen3'],
			                                                               'thumbnail1'    => $ve['thumbnail1'],
			                                                               'thumbnail2'    => $ve['thumbnail2'],
			                                                               'thumbnail3'    => $ve['thumbnail3'],
			                                                               'tipo'          => $ve['tipo'],
			                                                               'created'       => date('Y-m-d H:i:s'),
			                                                               'modified'      => date('Y-m-d H:i:s'),
			                                                               'registroid'    => $registroid,
			                                                               'rt_publicacione_id' => $ve['id'],
			                                                               'rt_usuario_id'      => $ve['usuario_id'],
			                                                               'rt_mycarid'         => $ve['mycar_id'],
			                                                              ]); 
		        	$data['mycarid'] = $ve['mycar_id'];
        	}//fin foreach
        	$usua  = Usuarios::where('id',       $data['usuarioid'])->get()->toArray();
	        $usua2 = Usuarios::where('mycar_id', $data['mycarid'])->get()->toArray();
	        $push_token = !empty($usua2[0]['push_token'])?$usua2[0]['push_token']:0;
	        $push_platf = !empty($usua2[0]['push_platf'])?$usua2[0]['push_platf']:0;
	        $foto2      = $usua[0]['foto2'];
	        $idio       = $usua2[0]['idioma'];
	                if($idio=="es"){
	                    $titulo  = "Olympus app";
	                    $mensaje = "@".$usua[0]['username'].": Compartio tu publicación en su perfil";
	        }else if($idio=="en"){
	                    $titulo  = "Olympus app";
	                    $mensaje = "@".$usua[0]['username'].": Shared your post on their profile";
	        }else{
	                    $titulo  = "Olympus app";
	                    $mensaje = "@".$usua[0]['username'].": Shared your post on their profile";
	        }
            if($usua[0]['id']!=$usua2[0]['id']){       
                  BasicController::notifpush($push_token, $push_platf, $titulo, $mensaje, $foto2, 'perfilpostverall/'.$data['publicid'].'/'.$data['usuarioid']);
                  $id_push =  DB::table('historialpushusuarios')->insertGetId(['titulo' => $titulo,
                                                                               'texto'  => $mensaje,
                                                                               'tipo'   => 4,//el 4 es compartir perfil
                                                                               'usuariomycar_id' => $usua[0]['id'],
                                                                               'mycar_id'        => $usua[0]['mycar_id'],
                                                                               'usuario_id'      => $usua2[0]['id'],
                                                                               'publicacione_id' => $data['publicid'],
                                                                               'created'     => date('Y-m-d H:i:s')
                                                                              ]
                                                                          );
            }

            $contar_puntos = Puntomensajes::where('usuario_id', $data['usuarioid'])->whereRaw("DATE(created) = '".date('Y-m-d')."'")->where('activo', '1')->count();
            if($contar_puntos<50){
                $id_punto =  DB::table('puntomensajes')->insertGetId(['usuario_id'  => $data['usuarioid'],
                                                                      'tipo_punto'  => 4,
                                                                      'punto'       => 25,
                                                                      'accion'      => 1,
                                                                      'created'     => date('Y-m-d H:i:s'),
                                                                      'modified'    => date('Y-m-d H:i:s')
                                                                  ]);
            }
        	return response()->json([
	                'code'=>200                   
	        ],200);
        }


}
?>