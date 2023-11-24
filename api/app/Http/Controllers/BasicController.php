<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Mensajes;
use \App\module;

use DB;
use Mail;


use App\Http\Controllers\Controller;
use JWTAuth;

class BasicController {
		/*
		*	FUnCION devuelve array con #
		*	
		*/
		public static  function gethastag($cadena=null, $tipo=1){
		    $explode = explode(" ", $cadena);
		    $arreglo = array();
		    $cad = "";
		    foreach ($explode as $key) {
		    	if(!empty($key)){
			    	if($key[0]=="#"){
			    		$arreglo[] = $key;
			    		$cad = $key." ".$cad;
			    	}
		    	}
		    }
		    if($tipo==1){
		    	return $arreglo;
		    }else{
		    	return $cad;
		    }
		}
		/*
		*	FUnCION PARA CARCULAR DISTANCIA
		*	
		*/
		public static  function getDistance(
												$latitude1=0, 
												$longitude1=0, 
												$latitude2=0, 
												$longitude2=0,
												$earth_radius = 6371			
											){
			if($latitude2==''){$latitude2=0;}
			if($longitude2==''){$longitude2=0;}
			
		    $dLat = deg2rad($latitude2 - $latitude1);
		    $dLon = deg2rad($longitude2 - $longitude1);
		 
		    $a = sin($dLat/2) * sin($dLat/2) + cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * sin($dLon/2) * sin($dLon/2);
		    $c = 2 * asin(sqrt($a));
		    $d = $earth_radius * $c;
		    return $d;
		}
		/*
		*
		*	ENvio de notifiaciones
		*/
		public static function notifpush($push_token, 
										 $push_platf, 
										 $titulo, 
										 $mensaje="", 
										 $foto="",
										 $ruta=""
										 ){
			if($foto==null || $foto==""){
				$foto=env('APP_URL_IMAGEN')."/activiticlass.png";
			}
			if(strlen($mensaje)>70){
				$mensaje =  substr($mensaje, 0, 70)."..";
			}
			$small_icon = $foto=env('APP_URL_IMAGEN')."/activiticlass.png";
			$not        = "";//"DATABASE OBJECT NOTIFICATION";
			$data       = null;
			$headers = [
			    'Content-Type: application/json; charset=utf-8;'
			];
			if($push_platf === 'ios') {
			    $data = [
			        'app_id'             => "118fad9d-6249-4f5f-be14-e94adb28da58",
			        'include_player_ids' => array($push_token),
			        "headings"           => array('en'=>$titulo),
			        "contents"           => array('en'=>$mensaje),
			        //"big_picture"      => $foto, //es para imagenes fotos grandes
			        //"ios_sound"          => "push.wav",
			        'data' => [		
 			        	"extra-key"    => "extra-value",
					    'notificacion' => 2,
					    'page'         =>  $ruta,
			        ],
			    ];
			}else if ($push_platf === 'android'){
			    $data = [
			        'app_id'             => "118fad9d-6249-4f5f-be14-e94adb28da58",
			        'include_player_ids' => array($push_token),
			        "headings"           => array('en'=>$titulo),
			        "contents"           => array('en'=>$mensaje),
			        //"big_picture"      => $foto, //es para imagenes fotos grandes
			       // "large_icon"         => $foto,
			        //"android_channel_id" => "d3b42f38-eeb3-44e1-b5d3-2c331604f2b5",
			        'data' => [		
 			        	"extra-key"    => "extra-value",
					    'notificacion' => 2,
					    'page'         =>  $ruta,
					    
			        ],
			    ];
			}
			$ch = curl_init();
			//curl_setopt( $ch,CURLOPT_URL, 'https://gcm-http.googleapis.com/gcm/send' );
			//curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
			curl_setopt( $ch,CURLOPT_URL, 'https://onesignal.com/api/v1/notifications' );
			curl_setopt( $ch,CURLOPT_POST, true );
			curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
			curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
			curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
			curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $data ) );
			curl_setopt($ch, CURLOPT_FAILONERROR, TRUE);
			$result = curl_exec($ch);
			curl_close( $ch );
			return true;
		}//fin function
		/*
		*	ENvio de push
		*/
		public static function enviopush($push_token, 
										 $push_platf, 
										 $titulo, 
										 $mensaje="", 
										 $foto="", 
										 $usuarioid_desty=0, 
										 $usuarioid_from=0
										 ){
			if($foto==null || $foto==""){
				$foto=env('APP_URL_IMAGEN')."/activiticlass.png";
			}
			if(strlen($mensaje)>70){
				$mensaje =  substr($mensaje, 0, 70)."..";
			}
			$small_icon = $foto=env('APP_URL_IMAGEN')."/activiticlass.png";
			$not        = "";//"DATABASE OBJECT NOTIFICATION";
			$data       = null;
			$headers = [
			    'Content-Type: application/json; charset=utf-8;'
			];
			if($push_platf === 'ios') {
			    $data = [
			        'app_id'             => "118fad9d-6249-4f5f-be14-e94adb28da58",
			        'include_player_ids' => array($push_token),
			        "headings"           => array('en'=>$titulo),
			        "contents"           => array('en'=>$mensaje),
			        //"big_picture"      => $foto, //es para imagenes fotos grandes
			        //"ios_sound"          => "push.wav",
			        'data' => [		
 			        	"extra-key"    => "extra-value",
					    'notimsj'      => self::comprobarmensajes($usuarioid_desty),
					    'listmsj'      => array(),
					    'chatmsj'      => array(),
					    'frommsj'      => $usuarioid_from,
					    'notificacion' => 1,
					    "page"         => "megafonomsj/".$usuarioid_from."/".$usuarioid_desty."/".$usuarioid_from."",
					    
			        ],
			    ];
			}else if ($push_platf === 'android'){
			    $data = [
			        'app_id'             => "118fad9d-6249-4f5f-be14-e94adb28da58",
			        'include_player_ids' => array($push_token),
			        "headings"           => array('en'=>$titulo),
			        "contents"           => array('en'=>$mensaje),
			        'data' => [		
 			        	"extra-key"    => "extra-value",
					    'notimsj'      => self::comprobarmensajes($usuarioid_desty),
					    'listmsj'      => array(),
					    'chatmsj'      => array(),
					    'frommsj'      => $usuarioid_from,
					    'notificacion' => 1,
					    "page"         => "megafonomsj/".$usuarioid_from."/".$usuarioid_desty."/".$usuarioid_from."",
					    
			        ],
			    ];
			}
			$ch = curl_init();
			//curl_setopt( $ch,CURLOPT_URL, 'https://gcm-http.googleapis.com/gcm/send' );
			//curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
			curl_setopt( $ch,CURLOPT_URL, 'https://onesignal.com/api/v1/notifications' );
			curl_setopt( $ch,CURLOPT_POST, true );
			curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
			curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
			curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
			curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $data ) );
			curl_setopt($ch, CURLOPT_FAILONERROR, TRUE);
			$result = curl_exec($ch);
			curl_close( $ch );
			return true;
		}//fin function
		/*
        *  Comprueba si hay mensajes nuevos
        */
        public static function comprobarmensajes($usuarioid=null){
            return Mensajes::where('usuarioid_desty',$usuarioid)->where('status',1)->count();   
        }
       

}
?>