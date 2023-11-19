<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Usuarios;
use \App\Models\Instalacionapp;

use \App\Models\Mycars;
use \App\Models\Mycarcalificaciones;
use \App\Models\Mycarsfavoritos;
use \App\Models\Mycartags;

use \App\Models\Mensajes;

use \App\Models\Publicaciones;

use \App\module;

use DB;
use Mail;

use App\Http\Controllers\Basic;
use App\Http\Controllers\Controller;
use JWTAuth;

class MensajeriaController extends Controller
{
        
        /*
        *
        *   FUncTION BASE IMAGEN
        */
        public function reducir($foto, $WIDTH=100, $HEIGHT=100, $QUALITY=100 , $ruta="" ) {
            $foto2 = str_replace("data:image/jpeg;base64,", "", $foto);
            $theme_image_little     = imagecreatefromstring(base64_decode($foto2));
            $org_w = imagesx($theme_image_little);
            $org_h = imagesy($theme_image_little);
            $image_little           = imagecreatetruecolor($WIDTH, $HEIGHT);
            imageinterlace($theme_image_little, true);
            imageinterlace($image_little, true);
            imagecopyresampled($image_little, $theme_image_little, 0, 0, 0, 0, $WIDTH, $HEIGHT, $org_w, $org_h);
            //ob_start();
            //imagejpeg($image_little, null, $QUALITY);
            imagewebp($image_little, $ruta, $QUALITY);
            //$contents =  ob_get_contents();
            //ob_end_clean();
            //return "data:image/jpeg;base64,".base64_encode($contents);
            return true;
        }
        /*
        *
        *   FUncTION BASE IMAGEN
        */
        public function base64_to_png( $base64_string, $output_file ) {
	          $foto = str_replace("data:image/jpeg;base64,", "", $base64_string);
	          $ifp  = fopen( $output_file, "wb" ); 
	          fwrite( $ifp, base64_decode( $foto) ); 
	          fclose( $ifp ); 
	          return($output_file);
	          //file_put_contents($output_file,base64_decode($base64_string));
	    }
        /*
        *
        *   FUncTION AGREGAR MENSAJE
        */
    	public function mensajeadd(Request $request){
        	$data = $request->json()->all();
        	// $data['usuarioid_from']
        	// $data['usuarioid_desty']
        	// $data['texto']
        	// $data['imagen']
        	$c1 = Mensajes::where('usuarioid_desty', $data['usuarioid_desty'])->where('usuarioid_from', $data['usuarioid_from'])->where('status','!=',3)->count();
        	$c2 = Mensajes::where('usuarioid_desty', $data['usuarioid_from'])->where('usuarioid_from', $data['usuarioid_desty'])->where('status','!=',3)->count();   
        	if($c1!=0 || $c2!=0){
        		$inicio = 1;
        	}else{
        		$inicio = 2;
        	}
        	if(isset($data['imagen'][0])){
                
	            $imgpath1  = storage_path('imagenes')."/".$data['usuarioid_from'].$data['usuarioid_desty'].date('Y-m-d-H-i-s')."_1.webp";
	            $imgpath1_ = env('APP_URL_IMAGEN')."/".$data['usuarioid_from'].$data['usuarioid_desty'].date('Y-m-d-H-i-s')."_1.webp";
                $img_reducir1 = $this->reducir($data['imagen'][0], 500, 500, 80, $imgpath1);
	            //$this->base64_to_png($img_reducir1, $imgpath1);
	            $data['texto'] = "Imagen";

                
                $imgpath2  = storage_path('imagenes')."/".$data['usuarioid_from'].$data['usuarioid_desty'].date('Y-m-d-H-i-s')."_2.webp";
                $imgpath2_ = env('APP_URL_IMAGEN')."/".$data['usuarioid_from'].$data['usuarioid_desty'].date('Y-m-d-H-i-s')."_2.webp";
                $theme_image_enc_little = $this->reducir($data['imagen'][0], 250, 250, 80, $imgpath2);
                //$this->base64_to_png($theme_image_enc_little, $imgpath2);

                
                $thumbnail1_  = storage_path('imagenes')."/".$data['usuarioid_from'].$data['usuarioid_desty'].date('Y-m-d-H-i-s')."th_1.webp";
                $thumbnail1   = env('APP_URL_IMAGEN')."/".$data['usuarioid_from'].$data['usuarioid_desty'].date('Y-m-d-H-i-s')."th_1.webp";
                $thum1        = $this->reducir($data['imagen'][0], 80, 80, 40, $thumbnail1_);
                //$this->base64_to_png($thum1, $thumbnail1_);
	        }else{
	            $imgpath1  = "";
	            $imgpath1_ = "";
                $imgpath2_ = "";
                $thumbnail1  = "";
	        }
        	$id_user  =  DB::table('mensajes')->insertGetId(['usuarioid_from'  => $data['usuarioid_from'],
	                                                         'usuarioid_desty' => $data['usuarioid_desty'],
	                                                         'texto'           => $data['texto'],
	                                                         'imagen'          => $imgpath1_,
                                                             'imagen_m'        => $imgpath2_,
                                                             'thumbnail1'      => $thumbnail1,
	                                                         'inicio'          => $inicio,
	                                                         'created'         => date('Y-m-d H:i:s')
	                                                       ]
	                                                    );
        	$usuarioid_desty = $data['usuarioid_desty'];
			$usuarioid_from  = $data['usuarioid_from'];
            Mensajes::where('usuarioid_from', '=', $data['usuarioid_desty'])->where('usuarioid_desty', '=', $data['usuarioid_from'])->where('status','!=',3)->update(['ultimo_msj' => date('Y-m-d-H-i-s')]);
            Mensajes::where('usuarioid_from', '=', $data['usuarioid_from'])->where('usuarioid_desty', '=', $data['usuarioid_desty'])->where('status','!=',3)->update(['ultimo_msj' => date('Y-m-d-H-i-s')]);
        	$datos = Mensajes::where(function($query) use ($usuarioid_desty, $usuarioid_from) {$query->where('usuarioid_from',  $usuarioid_desty)->orWhere('usuarioid_from',  $usuarioid_from);}
				              )->where(function($query) use ($usuarioid_desty, $usuarioid_from) {$query->where('usuarioid_desty', $usuarioid_desty)->orWhere('usuarioid_desty', $usuarioid_from);}
                              )->where('status','!=',3
				              )->orderBy('created', 'asc'
				              )->get()->toArray();  
			$contar = 0;
            $datos2 = array();
            if($data['usuarioid_from']==$data['usuarioid_buscar']){
                $usuario = $data['usuarioid_desty'];
            }else{
                $usuario = $data['usuarioid_from'];
            }
            foreach ($datos as $key) {
                    $activa = 0;
                    if($key['no1']==$usuario){$activa++;}
                    if($key['no2']==$usuario){$activa++;}
                    if($activa==0){
                        $datos2[$contar]= $key;
                        $datos2[$contar]['hora']  = date('d/m/Y h:i a', strtotime($key['created']));
                        $contar++;
                    }
            }   	
            $datos_para_usuario_from = Usuarios::find($data['usuarioid_from']);
            $datos_para_usuario = Usuarios::find($data['usuarioid_desty']);	
            if(strlen($data['texto'])>70){
                    $texto_notificacion = substr($data['texto'], 0, 70)."....";
            }else{
                    $texto_notificacion = $data['texto'];
            }
            BasicController::enviopush($datos_para_usuario->push_token, 
                                       $datos_para_usuario->push_platf,
                                       $datos_para_usuario_from->username,
                                       $datos_para_usuario_from->username.": ".$texto_notificacion,
                                       $datos_para_usuario_from->foto2,
                                       $data['usuarioid_desty'],
                                       $data['usuarioid_from']
                                       );
            Mensajes::where('usuarioid_from', '=', $data['usuarioid_desty'])->where('usuarioid_desty', '=', $data['usuarioid_from'])->where('status','!=',3)->update(['status' => 2]);                                                     
        	return response()->json([
        		'list'=>$datos2,
                'destino'=>$data['usuarioid_desty'],
                //'a'=>$datos_para_usuario->push_token, 
                //'b'=>$datos_para_usuario->push_platf,
                //'c'=>$datos_para_usuario_from->username,
                //'d'=>$datos_para_usuario_from->username.": ".$texto_notificacion,
                //'e'=>$datos_para_usuario_from->foto2,
                //'f'=>$data['usuarioid_desty'],
                //'g'=>$data['usuarioid_from'],
                'code'=>200                      
            ],200);
    	}
    	/*
        *
        *   FUncTION AGREGAR MENSAJE
        */
    	public function mensajelist(Request $request){
        	$data = $request->json()->all();
        	$usuarioid = $data['usuarioid'];
        	$datos_a = Mensajes::with('usuariosfrom'
                                     )->with('usuariosdesty'
                                    // )->where('inicio', '2'
                                     )->where('status','!=',3
                                     )->where(function($query) use ($usuarioid) {$query->where('usuarioid_from', $usuarioid)->orWhere('usuarioid_desty', $usuarioid);}
                                     )->orderBy('ultimo_msj', 'desc')->get();   
        	$datos   = $datos_a->toArray();
            $datos2  =array();
        	$contar = 0;
            $auxiliar_ver = 0;
            $contar_lista = 0;
            $lista        = array();
        	foreach ($datos as $key) {
                $activa = 0;
                foreach($lista as $keylista){
                    if($keylista['usuarioid_desty']==$key['usuarioid_desty'] && $keylista['usuarioid_from']==$key['usuarioid_from']){$activa++;}
                    if($keylista['usuarioid_desty']==$key['usuarioid_from']  && $keylista['usuarioid_from']==$key['usuarioid_desty']){$activa++;}

                }
                if($key['no1']==$usuarioid){$activa++;}
                if($key['no2']==$usuarioid){$activa++;}
                if($activa==0){
                    $lista[$contar_lista]['usuarioid_desty'] = $key['usuarioid_desty'];
                    $lista[$contar_lista]['usuarioid_from']  = $key['usuarioid_from'];
                    $contar_lista++;
        			$usuarioid_desty = $key['usuarioid_desty'];
        			$usuarioid_from  = $key['usuarioid_from'];
                    $auxiliar_ver=$usuarioid_desty;
                    $mensajes = 0;
                    if(isset($data['usuarioid'])){
                        if($usuarioid_from==$usuarioid){
                                $mensajes =  Mensajes::where('usuarioid_from', $usuarioid_desty)->where('usuarioid_desty',$data['usuarioid'])->where('status',1)->count();  
                        }else{
                                $mensajes =  Mensajes::where('usuarioid_from', $usuarioid_from)->where('usuarioid_desty',$data['usuarioid'])->where('status',1)->count();      
                        }
                        
                    }else{
                        $mensajes = 0;
                    }
        			//$c1 = Mensajes::where('usuarioid_desty', $data['usuarioid_desty'])->where('usuarioid_from', $data['usuarioid_from'])->count();
        			//$c2 = Mensajes::where('usuarioid_desty', $data['usuarioid_from'])->where('usuarioid_from', $data['usuarioid_desty'])->count();   
        			$datos_b = Mensajes::where(function($query) use ($usuarioid_desty, $usuarioid_from) {$query->where('usuarioid_from',  $usuarioid_desty)->orWhere('usuarioid_from',  $usuarioid_from);}
        				              )->where(function($query) use ($usuarioid_desty, $usuarioid_from) {$query->where('usuarioid_desty', $usuarioid_desty)->orWhere('usuarioid_desty', $usuarioid_from);}
                                      )->where('status','!=',3
        				              )->orderBy('created', 'desc'
        				              )->limit(1
        				              )->get()->toArray();   
                    $datos2[$contar] = $key;                                   
                    $datos2[$contar]['leido']   = $mensajes;
                    if(strlen($datos_b[0]['texto'])>80){
        			    $datos2[$contar]['mensaje'] = mb_substr($datos_b[0]['texto'], 0, 80)."...";
                    }else{
                        $datos2[$contar]['mensaje'] = $datos_b[0]['texto'];
                    }
        			$datos2[$contar]['hora']    = date('h:i a', strtotime($datos_b[0]['created']));
        			$contar++;
                }
        	}
        	return response()->json([
        		'list'=>$datos2,
                //'listo2'=>$lista,
                'code'=>200                      
            ],200);
    	}
        /*
        *
        *   FUncTION DELETE CHAT MENSAJE
        */
        public function megafonodelete(Request $request){
            $data = $request->json()->all();
            $usuarioid_desty   = $data['usuarioid_desty'];
            $usuarioid_from    = $data['usuarioid_from'];
            $usuarioid_buscar  = $data['usuarioid_buscar'];
            $usuarios   = Usuarios::where('id', $usuarioid_buscar)->get()->toArray();
            if(isset($data['usuarioid'])){
                $usuario = $data['usuarioid'];
                Mensajes::where('usuarioid_from', '=', $data['usuarioid_desty'])->where('usuarioid_desty', '=', $data['usuarioid_from'])->update(['no2' => $usuario]);
                Mensajes::where('usuarioid_from', '=', $data['usuarioid_from'])->where('usuarioid_desty', '=', $data['usuarioid_desty'])->update(['no1' => $usuario]);
            }else{
            }
            return response()->json([
                'code'=>200                      
            ],200);
        }


        /*
        *
        *   FUncTION DELETE CHAT MENSAJE
        */
        public function mensajemsjdelete(Request $request){
            $data = $request->json()->all();
            Mensajes::where('id', '=', $data['id'])->where('status','!=',3)->update(['status' => 3]);
            return response()->json([
                'code'=>200                      
            ],200);
        }



    	/*
        *
        *   FUncTION AGREGAR MENSAJE
        */
    	public function mensajemsj(Request $request){
        	$data = $request->json()->all();
			$usuarioid_desty   = $data['usuarioid_desty'];
			$usuarioid_from    = $data['usuarioid_from'];
			$usuarioid_buscar  = $data['usuarioid_buscar'];
			$usuarios   = Usuarios::where('id', $usuarioid_buscar)->get()->toArray();
            if($data['usuarioid_desty']==$usuarioid_buscar){
                    //$data['usuarioid_from']
                    Mensajes::where('usuarioid_from', '=', $data['usuarioid_desty'])->where('usuarioid_desty', '=', $data['usuarioid_from'])->where('status','!=',3)->update(['status' => 2]);
            }else{
                    //$data['usuarioid_desty']
                    Mensajes::where('usuarioid_from', '=', $data['usuarioid_from'])->where('usuarioid_desty', '=', $data['usuarioid_desty'])->where('status','!=',3)->update(['status' => 2]);
            }
			$datos = Mensajes::where(function($query) use ($usuarioid_desty, $usuarioid_from) {$query->where('usuarioid_from',  $usuarioid_desty)->orWhere('usuarioid_from',  $usuarioid_from);}
				              )->where(function($query) use ($usuarioid_desty, $usuarioid_from) {$query->where('usuarioid_desty', $usuarioid_desty)->orWhere('usuarioid_desty', $usuarioid_from);}
                              )->where('status','!=',3
				              )->orderBy('created', 'asc'
				              )->get()->toArray();  
			$contar = 0;
            $datos2 = array();
            if($data['usuarioid_from']==$data['usuarioid_buscar']){
                $usuario = $data['usuarioid_desty'];
            }else{
                $usuario = $data['usuarioid_from'];
            }
        	foreach ($datos as $key) {
                    $activa = 0;
                    if($key['no1']==$usuario){$activa++;}
                    if($key['no2']==$usuario){$activa++;}
                    if($activa==0){
                        $datos2[$contar]= $key;
            			$datos2[$contar]['hora']  = date('d/m/Y h:i a', strtotime($key['created']));
            			$contar++;
                    }
        	}					               
        	return response()->json([
        		'list'=>$datos2,
        		'usuarios'=>$usuarios,
                'code'=>200                      
            ],200);
    	}

        /*
        *
        *   FUncTION VER IMAGEN 
        */
        public function mensajemsjimg(Request $request){
            $data = $request->json()->all();
            $mensajeid = $data['mensajeid'];
            $datos = Mensajes::where('id', $mensajeid
                              )->where('status','!=',3
                              )->orderBy('created', 'asc'
                              )->get()->toArray();  
            return response()->json([
                'list'=>$datos,
                'code'=>200                      
            ],200);
        }
}
?>