<?php
App::uses('AppController', 'Controller');
/**
 * Categoriasubs Controller
 *
 * @property Categoriasub $Categoriasub
 * @property PaginatorComponent $Paginator
 * @property FlashComponent $Flash
 * @property SessionComponent $Session
 */
class VerificacionController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Flash', 'Session');


    var $uses = array('Mensaje', 'Mycarscomentario', 'Mycarcalificacione', 'Promocione', 'Publicacione', 'Usuario',  'Denuncia', 'Mycar', 'Historialpushusuario');
/*
** var de layout
*
*/
	public $layout = "principal";

/*
*  *  beforeFilter check de session
*
*/	
	public function beforeFilter() {
		$this->checkSession(7);
	}
/**
 * index method
 *
 * @return void
 */
	public function mensajes() {
     	  $usuario_rol      = $this->Session->read('usuario_rol');
     	  $usuario_id       = $this->Session->read('usuario_id');
          $this->set('datos', $this->Mensaje->find('all', array('conditions'=>array('Mensaje.valido'=>1))));
	}
/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void 
 */
	public function mensajesdelete($id = null) {
	    $this->layout  = "ajax";
	    $this->Mensaje->delete($id);
	}
/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void 
 */
	public function mensajesaceptar($id = null) {
	    $this->layout     = "ajax";
        $this->request->data['Mensaje']['id']     = $id;
	    $this->request->data['Mensaje']['valido'] = 2;
	    $this->Mensaje->save($this->request->data);
	}









	/**
 * index method
 *
 * @return void
 */
	public function mycarscomentario() {
     	  $usuario_rol      = $this->Session->read('usuario_rol');
     	  $usuario_id       = $this->Session->read('usuario_id');
          $this->set('datos', $this->Mycarscomentario->find('all', array('conditions'=>array('Mycarscomentario.valido'=>1))));
	}
/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void 
 */
	public function mycarscomentariodelete($id = null) {
	    $this->layout  = "ajax";
	    $this->Mycarscomentario->delete($id);
	}
/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void 
 */
	public function mycarscomentarioaceptar($id = null) {
	    $this->layout     = "ajax";
        $this->request->data['Mycarscomentario']['id']     = $id;
	    $this->request->data['Mycarscomentario']['valido'] = 2;
	    $this->Mycarscomentario->save($this->request->data);
	}













		/**
 * index method
 *
 * @return void
 */
	public function mycarcalificacione() {
     	  $usuario_rol      = $this->Session->read('usuario_rol');
     	  $usuario_id       = $this->Session->read('usuario_id');
          $this->set('datos', $this->Mycarcalificacione->find('all', array('conditions'=>array('Mycarcalificacione.valido'=>1))));
	}
/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void 
 */
	public function mycarcalificacionedelete($id = null) {
	    $this->layout  = "ajax";
	    $this->Mycarcalificacione->delete($id);
	}
/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void 
 */
	public function mycarcalificacioneaceptar($id = null) {
	    $this->layout     = "ajax";
        $this->request->data['Mycarcalificacione']['id']     = $id;
	    $this->request->data['Mycarcalificacione']['valido'] = 2;
	    $this->Mycarcalificacione->save($this->request->data);
	}















		/**
 * index method
 *
 * @return void
 */
	public function promocione() {
     	  $usuario_rol      = $this->Session->read('usuario_rol');
     	  $usuario_id       = $this->Session->read('usuario_id');
          $this->set('datos', $this->Promocione->find('all', array('conditions'=>array('Promocione.valido'=>1))));
	}
/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void 
 */
	public function promocionedelete($id = null) {
	    $this->layout  = "ajax";
	    $this->Promocione->delete($id);
	}
/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void 
 */
	public function promocioneaceptar($id = null) {
	    $this->layout     = "ajax";
        $this->request->data['Promocione']['id']     = $id;
	    $this->request->data['Promocione']['valido'] = 2;
	    $this->Promocione->save($this->request->data);
	}
























		/**
 * index method
 *
 * @return void
 */
	public function publicacione() {
     	  $usuario_rol      = $this->Session->read('usuario_rol');
     	  $usuario_id       = $this->Session->read('usuario_id');
          $this->set('datos', $this->Publicacione->find('all', array('conditions'=>array('Publicacione.valido'=>1))));
	}
/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void 
 */
	public function publicacionedelete($id = null) {
	    $this->layout  = "ajax";
	    $this->Publicacione->delete($id);
	}
/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void 
 */
	public function publicacioneaceptar($id = null) {
	    $this->layout     = "ajax";
        $this->request->data['Publicacione']['id']     = $id;
	    $this->request->data['Publicacione']['valido'] = 2;
	    $this->Publicacione->save($this->request->data);
	}

























		/**
 * index method
 *
 * @return void
 */
	public function usuarios() {
     	  $usuario_rol      = $this->Session->read('usuario_rol');
     	  $usuario_id       = $this->Session->read('usuario_id');
          $this->set('datos', $this->Usuario->find('all', array('conditions'=>array('Usuario.valido'=>1))));
	}
/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void 
 */
	public function usuariosedelete($id = null) {
	    $this->layout  = "ajax";
	    $this->Usuario->delete($id);
	}
/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void 
 */
	public function usuariosaceptar($id = null) {
	    $this->layout     = "ajax";
        $this->request->data['Usuario']['id']     = $id;
	    $this->request->data['Usuario']['valido'] = 2;
	    $this->Usuario->save($this->request->data);
	}










		/**
 * index method
 *
 * @return void
 */
	public function denuncias() {
     	  $usuario_rol      = $this->Session->read('usuario_rol');
     	  $usuario_id       = $this->Session->read('usuario_id');
          $this->set('datos', $this->Denuncia->find('all', array('conditions'=>array('Denuncia.valido'=>1))));
	}
/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void 
 */
	public function denunciasdelete1($id = null, $id2= null) {
	    $this->layout  = "ajax";
	    $this->Denuncia->delete($id);
	    $this->Mycar->delete($id2);
	    
	}
	/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void 
 */
	public function denunciasdelete2($id = null, $id2= null) {
	    $this->layout  = "ajax";
	    $this->Denuncia->delete($id);
	    $this->Publicacione->delete($id2);
	}
/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void 
 */
	public function denunciasaceptar($id = null) {
	    $this->layout     = "ajax";
        $this->request->data['Denuncia']['id']     = $id;
	    $this->request->data['Denuncia']['valido'] = 2;
	    $this->Denuncia->save($this->request->data);
	}










        /**
 * index method
 *
 * @return void
 */
    public function aprobacionusuarios() {

          $usuario_rol      = $this->Session->read('usuario_rol');
          $usuario_id       = $this->Session->read('usuario_id');
          $this->set('datos', $this->Usuario->find('all', array('conditions'=>array('OR' => array('Usuario.verificacion_3'=>'2', 'Usuario.verificacion_4'=>'2','Usuario.verificacion_5'=>'2')))));
    }



    public function aprobacionusuarios3($id = null) {
            $this->layout     = "ajax";
            $usuario_rol      = $this->Session->read('usuario_rol');
            $usuario_id       = $this->Session->read('usuario_id');
            $this->request->data['Usuario']['id']     = $id;
            $this->request->data['Usuario']['verificacion_3'] = 3;
            $this->Usuario->save($this->request->data);
            $Usuarios = $this->Historialpushusuario->Usuario->find('all', array('conditions'=>array('Usuario.id'=>$id)));
            foreach ($Usuarios as $key) {
                        $token = Configure::read('firebase');
                        $not   = "";//"DATABASE OBJECT NOTIFICATION";platform
                        //Datos/
                        $to_android = $key['Usuario']['push_token'];//$usuario[0]['User']['push_token'];//Datos del usuario
                        $to_ios     = $key['Usuario']['push_token'];//$usuario[0]['User']['push_token'];//Datos del usuario
                        $platform   = $key['Usuario']['push_platf'];//Datos del usuario
                        $titulo     = "Verificación de Identidad documento de identidad";
                        $mensaje    = "La Verificación de identidad relacionada con su documento de identidad fue aprobada";
                        $data       = null;
                        $foto="https://api.olympusapp.es/storage/imagenes/olympus.png";
                        $headers = [
                            'Content-Type: application/json; charset=utf-8;'
                        ];
                        if($platform === 'ios') {
                            $data = [
                                'app_id'             => "118fad9d-6249-4f5f-be14-e94adb28da58",
                                'include_player_ids' => array($to_ios),
                                "headings"           => array('en'=>$titulo),
                                "contents"           => array('en'=>$mensaje),
                                //"big_picture"      => $foto, //es para imagenes fotos grandes
                                //"ios_sound"          => "push.wav",
                                'data' => [     
                                    "extra-key"    => "extra-value",
                                    'notificacion' => 2,
                                    
                                ],
                            ];
                        }else if ($platform === 'android'){
                            $data = [
                                'app_id'             => "118fad9d-6249-4f5f-be14-e94adb28da58",
                                'include_player_ids' => array($to_android),
                                "headings"           => array('en'=>$titulo),
                                "contents"           => array('en'=>$mensaje),
                                //"big_picture"      => $foto, //es para imagenes fotos grandes
                                //"large_icon"         => $foto,
                                "android_channel_id" => "2e706bb8-c62d-47a9-876b-9ba20460e9d1",
                                'data' => [     
                                    "extra-key"    => "extra-value",
                                    'notificacion' => 2,
                                    
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
            }//fin function
    }



    public function rechaaprobacionusuarios3($id = null) {
            $this->layout     = "ajax";
            $usuario_rol      = $this->Session->read('usuario_rol');
            $usuario_id       = $this->Session->read('usuario_id');
            $this->request->data['Usuario']['id']     = $id;
            $this->request->data['Usuario']['verificacion_3'] = 1;
            $this->Usuario->save($this->request->data);
            $Usuarios = $this->Historialpushusuario->Usuario->find('all', array('conditions'=>array('Usuario.id'=>$id)));
            foreach ($Usuarios as $key) {
                        $token = Configure::read('firebase');
                        $not   = "";//"DATABASE OBJECT NOTIFICATION";platform
                        //Datos/
                        $to_android = $key['Usuario']['push_token'];//$usuario[0]['User']['push_token'];//Datos del usuario
                        $to_ios     = $key['Usuario']['push_token'];//$usuario[0]['User']['push_token'];//Datos del usuario
                        $platform   = $key['Usuario']['push_platf'];//Datos del usuario
                        $titulo     = "Verificación de Identidad documento de identidad";
                        $mensaje    = "La Verificación de identidad relacionada con su documento de identidad fue rechazada, debe verificar que sea legible para poder ser procesada";
                        $data       = null;
                        $foto="https://api.olympusapp.es/storage/imagenes/olympus.png";
                        $headers = [
                            'Content-Type: application/json; charset=utf-8;'
                        ];
                        if($platform === 'ios') {
                            $data = [
                                'app_id'             => "118fad9d-6249-4f5f-be14-e94adb28da58",
                                'include_player_ids' => array($to_ios),
                                "headings"           => array('en'=>$titulo),
                                "contents"           => array('en'=>$mensaje),
                                //"big_picture"      => $foto, //es para imagenes fotos grandes
                                //"ios_sound"          => "push.wav",
                                'data' => [     
                                    "extra-key"    => "extra-value",
                                    'notificacion' => 2,
                                    
                                ],
                            ];
                        }else if ($platform === 'android'){
                            $data = [
                                'app_id'             => "118fad9d-6249-4f5f-be14-e94adb28da58",
                                'include_player_ids' => array($to_android),
                                "headings"           => array('en'=>$titulo),
                                "contents"           => array('en'=>$mensaje),
                                //"big_picture"      => $foto, //es para imagenes fotos grandes
                                //"large_icon"         => $foto,
                                "android_channel_id" => "2e706bb8-c62d-47a9-876b-9ba20460e9d1",
                                'data' => [     
                                    "extra-key"    => "extra-value",
                                    'notificacion' => 2,
                                    
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
            }//fin function
    }







    public function aprobacionusuarios4($id = null) {
            $this->layout     = "ajax";
            $usuario_rol      = $this->Session->read('usuario_rol');
            $usuario_id       = $this->Session->read('usuario_id');
            $this->request->data['Usuario']['id']     = $id;
            $this->request->data['Usuario']['verificacion_4'] = 3;
            $this->Usuario->save($this->request->data);
            $Usuarios = $this->Historialpushusuario->Usuario->find('all', array('conditions'=>array('Usuario.id'=>$id)));
            foreach ($Usuarios as $key) {
                        $token = Configure::read('firebase');
                        $not   = "";//"DATABASE OBJECT NOTIFICATION";platform
                        //Datos/
                        $to_android = $key['Usuario']['push_token'];//$usuario[0]['User']['push_token'];//Datos del usuario
                        $to_ios     = $key['Usuario']['push_token'];//$usuario[0]['User']['push_token'];//Datos del usuario
                        $platform   = $key['Usuario']['push_platf'];//Datos del usuario
                        $titulo     = "Verificación de Identidad selfi";
                        $mensaje    = "La Verificación de identidad relacionada con su selfi fue aprobada";
                        $data       = null;
                        $foto="https://api.olympusapp.es/storage/imagenes/olympus.png";
                        $headers = [
                            'Content-Type: application/json; charset=utf-8;'
                        ];
                        if($platform === 'ios') {
                            $data = [
                                'app_id'             => "118fad9d-6249-4f5f-be14-e94adb28da58",
                                'include_player_ids' => array($to_ios),
                                "headings"           => array('en'=>$titulo),
                                "contents"           => array('en'=>$mensaje),
                                //"big_picture"      => $foto, //es para imagenes fotos grandes
                                //"ios_sound"          => "push.wav",
                                'data' => [     
                                    "extra-key"    => "extra-value",
                                    'notificacion' => 2,
                                    
                                ],
                            ];
                        }else if ($platform === 'android'){
                            $data = [
                                'app_id'             => "118fad9d-6249-4f5f-be14-e94adb28da58",
                                'include_player_ids' => array($to_android),
                                "headings"           => array('en'=>$titulo),
                                "contents"           => array('en'=>$mensaje),
                                //"big_picture"      => $foto, //es para imagenes fotos grandes
                                //"large_icon"         => $foto,
                                "android_channel_id" => "2e706bb8-c62d-47a9-876b-9ba20460e9d1",
                                'data' => [     
                                    "extra-key"    => "extra-value",
                                    'notificacion' => 2,
                                    
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
            }//fin function
    }

    public function rechaaprobacionusuarios4($id = null) {
            $this->layout     = "ajax";
            $usuario_rol      = $this->Session->read('usuario_rol');
            $usuario_id       = $this->Session->read('usuario_id');
            $this->request->data['Usuario']['id']     = $id;
            $this->request->data['Usuario']['verificacion_4'] = 1;
            $this->Usuario->save($this->request->data);
            $Usuarios = $this->Historialpushusuario->Usuario->find('all', array('conditions'=>array('Usuario.id'=>$id)));
            foreach ($Usuarios as $key) {
                        $token = Configure::read('firebase');
                        $not   = "";//"DATABASE OBJECT NOTIFICATION";platform
                        //Datos/
                        $to_android = $key['Usuario']['push_token'];//$usuario[0]['User']['push_token'];//Datos del usuario
                        $to_ios     = $key['Usuario']['push_token'];//$usuario[0]['User']['push_token'];//Datos del usuario
                        $platform   = $key['Usuario']['push_platf'];//Datos del usuario
                        $titulo     = "Verificación de Identidad selfi";
                        $mensaje    = "La Verificación de identidad relacionada con su selfi fue rechazada, debe verificar que sea legible su informacion para poder ser procesada";
                        $data       = null;
                        $foto="https://api.olympusapp.es/storage/imagenes/olympus.png";
                        $headers = [
                            'Content-Type: application/json; charset=utf-8;'
                        ];
                        if($platform === 'ios') {
                            $data = [
                                'app_id'             => "118fad9d-6249-4f5f-be14-e94adb28da58",
                                'include_player_ids' => array($to_ios),
                                "headings"           => array('en'=>$titulo),
                                "contents"           => array('en'=>$mensaje),
                                //"big_picture"      => $foto, //es para imagenes fotos grandes
                                //"ios_sound"          => "push.wav",
                                'data' => [     
                                    "extra-key"    => "extra-value",
                                    'notificacion' => 2,
                                    
                                ],
                            ];
                        }else if ($platform === 'android'){
                            $data = [
                                'app_id'             => "118fad9d-6249-4f5f-be14-e94adb28da58",
                                'include_player_ids' => array($to_android),
                                "headings"           => array('en'=>$titulo),
                                "contents"           => array('en'=>$mensaje),
                                //"big_picture"      => $foto, //es para imagenes fotos grandes
                                //"large_icon"         => $foto,
                                "android_channel_id" => "2e706bb8-c62d-47a9-876b-9ba20460e9d1",
                                'data' => [     
                                    "extra-key"    => "extra-value",
                                    'notificacion' => 2,
                                    
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
            }//fin function
    }








    public function aprobacionusuarios5($id = null) {
            $this->layout     = "ajax";
            $usuario_rol      = $this->Session->read('usuario_rol');
            $usuario_id       = $this->Session->read('usuario_id');
            $this->request->data['Usuario']['id']     = $id;
            $this->request->data['Usuario']['verificacion_5'] = 3;
            $this->Usuario->save($this->request->data);
            $Usuarios = $this->Historialpushusuario->Usuario->find('all', array('conditions'=>array('Usuario.id'=>$id)));
            foreach ($Usuarios as $key) {
                        $token = Configure::read('firebase');
                        $not   = "";//"DATABASE OBJECT NOTIFICATION";platform
                        //Datos/
                        $to_android = $key['Usuario']['push_token'];//$usuario[0]['User']['push_token'];//Datos del usuario
                        $to_ios     = $key['Usuario']['push_token'];//$usuario[0]['User']['push_token'];//Datos del usuario
                        $platform   = $key['Usuario']['push_platf'];//Datos del usuario
                        $titulo     = "Verificación de Identidad sitio de Ubicación";
                        $mensaje    = "La Verificación de identidad relacionada con su Ubicación fue aprobada";
                        $data       = null;
                        $foto="https://api.olympusapp.es/storage/imagenes/olympus.png";
                        $headers = [
                            'Content-Type: application/json; charset=utf-8;'
                        ];
                        if($platform === 'ios') {
                            $data = [
                                'app_id'             => "118fad9d-6249-4f5f-be14-e94adb28da58",
                                'include_player_ids' => array($to_ios),
                                "headings"           => array('en'=>$titulo),
                                "contents"           => array('en'=>$mensaje),
                                //"big_picture"      => $foto, //es para imagenes fotos grandes
                                //"ios_sound"          => "push.wav",
                                'data' => [     
                                    "extra-key"    => "extra-value",
                                    'notificacion' => 2,
                                    
                                ],
                            ];
                        }else if ($platform === 'android'){
                            $data = [
                                'app_id'             => "118fad9d-6249-4f5f-be14-e94adb28da58",
                                'include_player_ids' => array($to_android),
                                "headings"           => array('en'=>$titulo),
                                "contents"           => array('en'=>$mensaje),
                                //"big_picture"      => $foto, //es para imagenes fotos grandes
                                //"large_icon"         => $foto,
                                "android_channel_id" => "2e706bb8-c62d-47a9-876b-9ba20460e9d1",
                                'data' => [     
                                    "extra-key"    => "extra-value",
                                    'notificacion' => 2,
                                    
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
            }//fin function
    }


    public function rechaaprobacionusuarios5($id = null) {
            $this->layout     = "ajax";
            $usuario_rol      = $this->Session->read('usuario_rol');
            $usuario_id       = $this->Session->read('usuario_id');
            $this->request->data['Usuario']['id']     = $id;
            $this->request->data['Usuario']['verificacion_5'] = 1;
            $this->Usuario->save($this->request->data);
            $Usuarios = $this->Historialpushusuario->Usuario->find('all', array('conditions'=>array('Usuario.id'=>$id)));
            foreach ($Usuarios as $key) {
                        $token = Configure::read('firebase');
                        $not   = "";//"DATABASE OBJECT NOTIFICATION";platform
                        //Datos/
                        $to_android = $key['Usuario']['push_token'];//$usuario[0]['User']['push_token'];//Datos del usuario
                        $to_ios     = $key['Usuario']['push_token'];//$usuario[0]['User']['push_token'];//Datos del usuario
                        $platform   = $key['Usuario']['push_platf'];//Datos del usuario
                        $titulo     = "Verificación de Identidad sitio de Ubicación";
                        $mensaje    = "La Verificación de identidad relacionada con su Ubicación fue rechazada, debe verificar que el documento sea legible o que relacionado al documento de identidad enviado";
                        $data       = null;
                        $foto="https://api.olympusapp.es/storage/imagenes/olympus.png";
                        $headers = [
                            'Content-Type: application/json; charset=utf-8;'
                        ];
                        if($platform === 'ios') {
                            $data = [
                                'app_id'             => "118fad9d-6249-4f5f-be14-e94adb28da58",
                                'include_player_ids' => array($to_ios),
                                "headings"           => array('en'=>$titulo),
                                "contents"           => array('en'=>$mensaje),
                                //"big_picture"      => $foto, //es para imagenes fotos grandes
                                //"ios_sound"          => "push.wav",
                                'data' => [     
                                    "extra-key"    => "extra-value",
                                    'notificacion' => 2,
                                    
                                ],
                            ];
                        }else if ($platform === 'android'){
                            $data = [
                                'app_id'             => "118fad9d-6249-4f5f-be14-e94adb28da58",
                                'include_player_ids' => array($to_android),
                                "headings"           => array('en'=>$titulo),
                                "contents"           => array('en'=>$mensaje),
                                //"big_picture"      => $foto, //es para imagenes fotos grandes
                                //"large_icon"         => $foto,
                                "android_channel_id" => "2e706bb8-c62d-47a9-876b-9ba20460e9d1",
                                'data' => [     
                                    "extra-key"    => "extra-value",
                                    'notificacion' => 2,
                                    
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
            }//fin function
    }




}
?>
