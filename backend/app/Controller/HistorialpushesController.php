<?php
App::uses('AppController', 'Controller');
/**
 * Historialpushes Controller
 *
 * @property Historialpush $Historialpush
 * @property PaginatorComponent $Paginator
 * @property FlashComponent $Flash
 * @property SessionComponent $Session
 */
class HistorialpushesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Flash', 'Session');

	var $uses = array('Historialpush', 'Usuario', 'Historialpushusuario', 'Instalacionapp','Mycar', 'Valoraciones', 'Asistentechats');

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
		$this->checkSession(2);
	}

/**
 * index method
 *
 * @return void
 */
	public function index() {
     	  $usuario_rol      = $this->Session->read('usuario_rol');
     	  $usuario_id       = $this->Session->read('usuario_id');
          $this->set('historialpushes', $this->Historialpush->find('all', array('conditions'=>array())));
     	
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
	    $usuario_rol      = $this->Session->read('usuario_rol');
     	$usuario_id       = $this->Session->read('usuario_id');
		if (!$this->Historialpush->exists($id)) {
			throw new NotFoundException(__('Invalid historialpush'));
		}
		$options = array('conditions' => array('Historialpush.' . $this->Historialpush->primaryKey => $id));
		$this->set('historialpush', $this->Historialpush->find('first', $options));
	}


/**
 * add method
 *
 * @return void
 */
	public function instalados() {
	    $usuario_rol      = $this->Session->read('usuario_rol');
     	$usuario_id       = $this->Session->read('usuario_id');
		if ($this->request->is('post')) {
			$this->Historialpush->create();
			$this->request->data['Historialpush']['activo']=2;
			if ($this->Historialpush->save($this->request->data)) {
				$Usuarios = $this->Instalacionapp->find('all', array('conditions'=>array()));
                foreach ($Usuarios as $key) {
									$token = Configure::read('firebase');
									$not   = "";//"DATABASE OBJECT NOTIFICATION";
									//Datos/
									$to_android = $key['Instalacionapp']['registerid'];//$usuario[0]['User']['push_token'];//Datos del usuario
									$to_ios     = $key['Instalacionapp']['registerid'];//$usuario[0]['User']['push_token'];//Datos del usuario
									$platform   = $key['Instalacionapp']['plataforma'];//Datos del usuario
									$titulo     = $this->request->data['Historialpush']['titulo'];
									$mensaje    = $this->request->data['Historialpush']['texto'];
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
				$this->Flash->success(__('Registro Guardado.'));
				return $this->redirect(array('action' => 'publicar'));
			} else {
				$this->Flash->error(__('Registro no Guardado. Por favor, inténtelo de nuevo.'));
			}
		}
	}




/**
 * add method
 *
 * @return void
 */
	public function publicar() {
	    $usuario_rol      = $this->Session->read('usuario_rol');
     	$usuario_id       = $this->Session->read('usuario_id');
		if ($this->request->is('post')) {
			$this->Historialpush->create();
			$this->request->data['Historialpush']['activo']=2;
			if ($this->Historialpush->save($this->request->data)) {
				$Usuarios = $this->Usuario->find('all', array('conditions'=>array()));
                foreach ($Usuarios as $key) {
                	if(isset($key['Publicacione'][0]['id'])){
									$this->request->data['Historialpushusuario']['usuario_id'] = $key['Usuario']['id'];
									$this->request->data['Historialpushusuario']['titulo']     = $this->request->data['Historialpush']['titulo'];
									$this->request->data['Historialpushusuario']['texto']      = $this->request->data['Historialpush']['texto'];
		                			$this->Historialpushusuario->create();
		                			$this->Historialpushusuario->save($this->request->data);
									$token = Configure::read('firebase');
									$not   = "";//"DATABASE OBJECT NOTIFICATION";
									//Datos/
									$to_android = $key['Usuario']['push_token'];//$usuario[0]['User']['push_token'];//Datos del usuario
									$to_ios     = $key['Usuario']['push_token'];//$usuario[0]['User']['push_token'];//Datos del usuario
									$platform   = $key['Usuario']['push_platf'];//Datos del usuario
									$titulo     = $this->request->data['Historialpush']['titulo'];
									$mensaje    = $this->request->data['Historialpush']['texto'];
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
					}
				}//fin function
				$this->Flash->success(__('Registro Guardado.'));
				return $this->redirect(array('action' => 'publicar'));
			} else {
				$this->Flash->error(__('Registro no Guardado. Por favor, inténtelo de nuevo.'));
			}
		}
	}



	/**
 * add method
 *
 * @return void
 */
	public function sinpublicar() {
	    $usuario_rol      = $this->Session->read('usuario_rol');
     	$usuario_id       = $this->Session->read('usuario_id');
		if ($this->request->is('post')) {
			$this->Historialpush->create();
			$this->request->data['Historialpush']['activo']=2;
			if ($this->Historialpush->save($this->request->data)) {
				$Usuarios = $this->Usuario->find('all', array('conditions'=>array()));
                foreach ($Usuarios as $key) {
                	if(!isset($key['Publicacione'][0]['id'])){
									$this->request->data['Historialpushusuario']['usuario_id'] = $key['Usuario']['id'];
									$this->request->data['Historialpushusuario']['titulo']     = $this->request->data['Historialpush']['titulo'];
									$this->request->data['Historialpushusuario']['texto']      = $this->request->data['Historialpush']['texto'];
		                			$this->Historialpushusuario->create();
		                			$this->Historialpushusuario->save($this->request->data);
									$token = Configure::read('firebase');
									$not   = "";//"DATABASE OBJECT NOTIFICATION";
									//Datos/
									$to_android = $key['Usuario']['push_token'];//$usuario[0]['User']['push_token'];//Datos del usuario
									$to_ios     = $key['Usuario']['push_token'];//$usuario[0]['User']['push_token'];//Datos del usuario
									$platform   = $key['Usuario']['push_platf'];//Datos del usuario
									$titulo     = $this->request->data['Historialpush']['titulo'];
									$mensaje    = $this->request->data['Historialpush']['texto'];
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
					}
				}//fin function
				$this->Flash->success(__('Registro Guardado.'));
				return $this->redirect(array('action' => 'sinpublicar'));
			} else {
				$this->Flash->error(__('Registro no Guardado. Por favor, inténtelo de nuevo.'));
			}
		}
	}




/**
 * add method
 *
 * @return void
 */
	public function add() {
	    $usuario_rol      = $this->Session->read('usuario_rol');
     	$usuario_id       = $this->Session->read('usuario_id');
		if ($this->request->is('post')) {
			$this->Historialpush->create();
			$this->request->data['Historialpush']['activo']=2;
			if ($this->Historialpush->save($this->request->data)) {
				$Usuarios = $this->Usuario->find('all', array('conditions'=>array()));
                foreach ($Usuarios as $key) {
							$this->request->data['Historialpushusuario']['usuario_id'] = $key['Usuario']['id'];
							$this->request->data['Historialpushusuario']['titulo']     = $this->request->data['Historialpush']['titulo'];
							$this->request->data['Historialpushusuario']['texto']      = $this->request->data['Historialpush']['texto'];
                			$this->Historialpushusuario->create();
                			$this->Historialpushusuario->save($this->request->data);
							$token = Configure::read('firebase');
							$not   = "";//"DATABASE OBJECT NOTIFICATION";
							//Datos/
							$to_android = $key['Usuario']['push_token'];//$usuario[0]['User']['push_token'];//Datos del usuario
							$to_ios     = $key['Usuario']['push_token'];//$usuario[0]['User']['push_token'];//Datos del usuario
							$platform   = $key['Usuario']['push_platf'];//Datos del usuario
							$titulo     = $this->request->data['Historialpush']['titulo'];
							$mensaje    = $this->request->data['Historialpush']['texto'];
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
				$this->Flash->success(__('Registro Guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('Registro no Guardado. Por favor, inténtelo de nuevo.'));
			}
		}
	}


	
/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void 
 */
	public function delete($id = null) {
	    $this->layout     = "ajax";
	    $usuario_rol      = $this->Session->read('usuario_rol');
     	$usuario_id       = $this->Session->read('usuario_id');
        $this->request->data['Historialpush']['id']     = $id;
	    $this->request->data['Historialpush']['activo'] = 2;
	    $this->Historialpush->save($this->request->data);
	}













/**
 * add method
 *
 * @return void
 */
	public function conasistentevirtual() {
	    $usuario_rol      = $this->Session->read('usuario_rol');
     	$usuario_id       = $this->Session->read('usuario_id');
		if ($this->request->is('post')) {
			$this->Historialpush->create();
			$this->request->data['Historialpush']['activo']=2;
			if ($this->Historialpush->save($this->request->data)) {
				$asistentes = $this->Mycar->find('all', array('conditions'=>array('Mycar.produtos_servicios_ofrecidos !='=>'')));
				foreach ($asistentes as $key_asistente) {
									$Usuarios = $this->Usuario->find('all', array('conditions'=>array('Usuario.id'=>$key_asistente['Mycar']['usuario_id'])));
					                foreach ($Usuarios as $key) {
												$this->request->data['Historialpushusuario']['usuario_id'] = $key['Usuario']['id'];
												$this->request->data['Historialpushusuario']['titulo']     = $this->request->data['Historialpush']['titulo'];
												$this->request->data['Historialpushusuario']['texto']      = $this->request->data['Historialpush']['texto'];
					                			$this->Historialpushusuario->create();
					                			$this->Historialpushusuario->save($this->request->data);
												$token = Configure::read('firebase');
												$not   = "";//"DATABASE OBJECT NOTIFICATION";
												//Datos/
												$to_android = $key['Usuario']['push_token'];//$usuario[0]['User']['push_token'];//Datos del usuario
												$to_ios     = $key['Usuario']['push_token'];//$usuario[0]['User']['push_token'];//Datos del usuario
												$platform   = $key['Usuario']['push_platf'];//Datos del usuario
												$titulo     = $this->request->data['Historialpush']['titulo'];
												$mensaje    = $this->request->data['Historialpush']['texto'];
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
												        "android_channel_id" => "2e706bb8-c62d-47a9-876b-9ba20460e9d1",
												        'data' => [		
									 			        	"extra-key"    => "extra-value",
														    'notificacion' => 2,
														    
												        ],
												    ];
												}
												$ch = curl_init();
												curl_setopt( $ch,CURLOPT_URL, 'https://onesignal.com/api/v1/notifications' );
												curl_setopt( $ch,CURLOPT_POST, true );
												curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
												curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
												curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
												curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $data ) );
												curl_setopt($ch, CURLOPT_FAILONERROR, TRUE);
												$result = curl_exec($ch);
												curl_close( $ch );
									}//fin foreach

				}//fin foreach
				$this->Flash->success(__('Notificaciones enviadas.'));
				return $this->redirect(array('controller' => 'principal', 'action' => 'index'));
			} else {
				$this->Flash->error(__('Registro no Guardado. Por favor, inténtelo de nuevo.'));
			}
		}
	}











	/**
 * add method
 *
 * @return void
 */
	public function marketingwhatsapp() {
	    $usuario_rol      = $this->Session->read('usuario_rol');
     	$usuario_id       = $this->Session->read('usuario_id');
		if ($this->request->is('post')) {
			$this->request->data['Historialpush']['titulo']  = "Marketing whatsapp";
			$this->request->data['Historialpush']['activo'] = 2;
			$this->Historialpush->create();
			if ($this->Historialpush->save($this->request->data)) {
				$asistentes = $this->Mycar->find('all', array('conditions'=>array('Mycar.telefono !='=>'', 'Mycar.codigo_pais !='=>'')));
				foreach ($asistentes as $key_asistente) {
									$Usuarios = $this->Usuario->find('all', array('conditions'=>array('Usuario.id'=>$key_asistente['Mycar']['usuario_id'])));
					                foreach ($Usuarios as $key) {
					                			$this->request->data['Historialpush']['texto'] = str_replace("@usuario", "@".$key['Usuario']['username'], $this->request->data['Historialpush']['texto']);
												$this->request->data['Historialpushusuario']['usuario_id'] = $key['Usuario']['id'];
												$this->request->data['Historialpushusuario']['titulo']     = "Marketing whatsapp";
												$this->request->data['Historialpushusuario']['texto']      = $this->request->data['Historialpush']['texto'];
					                			$this->Historialpushusuario->create();
					                			$this->Historialpushusuario->save($this->request->data);
												$token = Configure::read('firebase');
												$telefono_whatsapp = $key_asistente['Mycar']['codigo_pais'].$key_asistente['Mycar']['telefono'];
												$toke_bearer = "EAAiivsSmhzwBAElcqIMaalFSFU2YvL55uw1yjolW0hSgSBJdWxys4uZCa4XtFZCCU22JZBM2AaAyswDRQpXzUpuCiiqo3NVWD0TJK39Af2ZBWAOC5EQj5dzJikCGG5diorZAcw7mi9cc5iv3ffeIhaeEMbtpradNGX8A0lZCD2jhnohpCcN5nR90YgWQ0rVIf2LoUoCEudnAZDZD";
												$headers = [
									                'Content-Type: application/json; charset=utf-8;',
									                'Authorization: Bearer '.$toke_bearer 
									            ];
									            $data_w = [
									                'to'   => $telefono_whatsapp,
									                "type" => 'text',
									                "messaging_product"=> "whatsapp",
									                "text"  => array('body'=>$this->request->data['Historialpush']['texto'])
									            ];
												//Whatsapp id de Olympus Bussines whatsapp
										    	$whatsapp_id="104823082639201"; 
										    	$ch = curl_init();
									            curl_setopt( $ch,CURLOPT_URL, 'https://graph.facebook.com/v17.0/'.$whatsapp_id.'/messages' );
									            curl_setopt( $ch,CURLOPT_POST, true );
									            curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
									            curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
									            curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
									            curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $data_w ));
									            curl_setopt($ch, CURLOPT_FAILONERROR, TRUE);
									            $response2 = json_decode(curl_exec($ch));
												curl_close($ch);
									}//fin foreach

				}//fin foreach
				$this->Flash->success(__('Mensaje de whatsapp enviados'));
				return $this->redirect(array('controller' => 'principal', 'action' => 'index'));
			} else {
				$this->Flash->error(__('Registro no Guardado. Por favor, inténtelo de nuevo.'));
			}
		}
	}




/**
 * add method
 *
 * @return void
 */
	public function marketingwhatsapp2() {
	    $usuario_rol      = $this->Session->read('usuario_rol');
     	$usuario_id       = $this->Session->read('usuario_id');
     	$fecha_actual = date("Y-m-d");
        //sumo 7 día
        $sumardias  =  date("Y-m-d",strtotime($fecha_actual."+ 6 days")); 
        //resto 4 día
        $restardias =  date("Y-m-d",strtotime($fecha_actual."- 4 days")); 
        //sumo 3 meses
        $sumarmeses  =  date("Y-m-d",strtotime($fecha_actual."+ 2 month")); 
        //resto 7 meses
        $restarmeses =  date("Y-m",strtotime($fecha_actual."- 2 month")).'-01'; 
		if ($this->request->is('post')) {
			$this->request->data['Historialpush']['titulo']  = "Estadisticas whatsapp";
			$this->request->data['Historialpush']['activo'] = 2;
			$this->Historialpush->create();
			if ($this->Historialpush->save($this->request->data)) {
				$asistentes = $this->Mycar->find('all', array('conditions'=>array('Mycar.telefono !='=>'', 'Mycar.codigo_pais !='=>'')));
				foreach ($asistentes as $key_asistente) {
									$Usuarios = $this->Usuario->find('all', array('conditions'=>array('Usuario.id'=>$key_asistente['Mycar']['usuario_id'])));
					                foreach ($Usuarios as $key) {
					                			//$this->request->data['Historialpush']['texto'] = str_replace("@usuario", "@".$key['Usuario']['username'], $this->request->data['Historialpush']['texto']);

					                			$estadisticas_original = $this->Valoraciones->find('all', array('conditions'=>array('Valoraciones.mycar_id'=>$key_asistente['Mycar']['id'])));
								                $contar_estadistica = 0;
								                foreach($estadisticas_original as $esta_ver){
								                          if($esta_ver['Valoraciones']['tipo']==1){ $estadisticas[$contar_estadistica]['count_like']        = !isset($estadisticas[$contar_estadistica]['count_like'])?1:$estadisticas[$contar_estadistica]['count_like']+1;

								                    }else if($esta_ver['Valoraciones']['tipo']==2){ $estadisticas[$contar_estadistica]['count_visitas']     = !isset($estadisticas[$contar_estadistica]['count_visitas'])?1:$estadisticas[$contar_estadistica]['count_visitas']+1;

								                    }else if($esta_ver['Valoraciones']['tipo']==8){ $estadisticas[$contar_estadistica]['count_comentarios'] = !isset($estadisticas[$contar_estadistica]['count_comentarios'])?1:$estadisticas[$contar_estadistica]['count_comentarios']+1;

								                    }
								                }


												$estadisticas_original_fecha = $this->Valoraciones->find('all', array('conditions'=>array('Valoraciones.mycar_id'=>$key_asistente['Mycar']['id'], 'Valoraciones.created BETWEEN "'.$restardias.'" and "'.$fecha_actual.' 23:59:00"')));															                                                                    
								                $bandera = '';
								                $cantidad_fecha_like = array();
								                $contar_estadistica2 = -1;
								                foreach($estadisticas_original_fecha as $esta_ver2){
								                    $esta_ver2['Valoraciones']['created'] = date("Y-m-d", strtotime($esta_ver2['Valoraciones']['created']));
								                    if($esta_ver2['Valoraciones']['tipo']==1){ 
								                        if($bandera!=$esta_ver2['Valoraciones']['created']){
								                            $bandera = $esta_ver2['Valoraciones']['created'];
								                            $contar_estadistica2++;
								                        }
								                        $cantidad_fecha_like[$contar_estadistica2]['valor'] = isset($cantidad_fecha_like[$contar_estadistica2]['valor'])?$cantidad_fecha_like[$contar_estadistica2]['valor']+1:1; 
								                        $cantidad_fecha_like[$contar_estadistica2]['fecha'] = $esta_ver2['Valoraciones']['created'];
								                    }
								                }

								                $bandera = '';
								                $cantidad_fecha_visitas = array();
								                $contar_estadistica3 = -1;
								                foreach($estadisticas_original_fecha as $esta_ver2){
								                    $esta_ver2['Valoraciones']['created'] = date("Y-m-d", strtotime($esta_ver2['Valoraciones']['created']));
								                    if($esta_ver2['Valoraciones']['tipo']==2){ 
								                        if($bandera!=$esta_ver2['Valoraciones']['created']){
								                            $bandera = $esta_ver2['Valoraciones']['created'];
								                            $contar_estadistica3++;
								                        }
								                        $cantidad_fecha_visitas[$contar_estadistica3]['valor'] = isset($cantidad_fecha_visitas[$contar_estadistica3]['valor'])?$cantidad_fecha_visitas[$contar_estadistica3]['valor']+1:1; 
								                        $cantidad_fecha_visitas[$contar_estadistica3]['fecha'] = $esta_ver2['Valoraciones']['created'];
								                    }
								                }



					                			$estadistica  = "Saludos estimado *@".$key['Usuario']['username']."*, Olympus app le hace envio de las estadísticas de su perfil hasta le dia de ".date("Y/m/d");
					                			$estadistica .= "\n\n";	
					                			$estadistica .= "*Estadísticas*";		
					                			$estadistica .= "\n\n";
					                			$estadistica .= "Like en tus publicaciones: *".$estadisticas[0]['count_like']."*";
					                			$estadistica .= "\n";
					                			$estadistica .= "Visitas a tu perfil: *".$estadisticas[0]['count_visitas']."*";
					                			$estadistica .= "\n";
					                			$estadistica .= "Comentarios en tus publicaciones: *".$estadisticas[0]['count_comentarios']."*";


					                			$estadistica .= "\n\n";	
					                			$estadistica .= "*Like detallados* ";		
					                			$estadistica .= "\n";
					                			foreach($cantidad_fecha_like as $ver1){
					                				$estadistica .= "\n Fecha: ".$ver1['fecha']." Likes: *".$ver1['valor']."*";	
					                			}

					                			$estadistica .= "\n\n";	
					                			$estadistica .= "*Visitas detalladas* ";		
					                			$estadistica .= "\n";
					                			foreach($cantidad_fecha_visitas as $ver2){
					                				$estadistica .= "\n Fecha: ".$ver2['fecha']." Visitas: *".$ver2['valor']."*";	
					                			}


					                			$asistente_original_fecha = $this->Asistentechats->find('all', array('order'=>array('Asistentechats.usuario_chat_id'=>'asc'), 'conditions'=>array('Asistentechats.usuario_id'=>$key_asistente['Mycar']['usuario_id'], 'Asistentechats.created BETWEEN "'.$restardias.'" and "'.$fecha_actual.' 23:59:00"')));															                                                                    
					                			$contar_conversaciones = 0;
					                			$contar_conversaciones_aux = 0;
					                			foreach($asistente_original_fecha as $ver3){
					                				if($ver3['Asistentechats']['usuario_chat_id']!=$contar_conversaciones_aux){
					                					$contar_conversaciones_aux = $ver3['Asistentechats']['usuario_chat_id'];
					                					$contar_conversaciones++;
					                				}
					                			}

					                			$estadistica .= "\n\n";	
					                			$estadistica .= "*Asistente virtual* ";	
					                			$estadistica .= "\n\n ";
					                			$estadistica .= "Chat realizados: *". $contar_conversaciones ."*";	


					                			$estadistica .= "\n\n";		
					                			$estadistica .= "*Nota:* Recuerda actualizar tu perfil y tu asistente virtual para que así aumente tu alcance.";	

					                			$estadistica .= "\n\n";		
					                			$estadistica .= "Puedes actualizar o compartir olympus desde el siguiente link: https://play.google.com/store/apps/details?id=com.olympus.push";



					                			$this->request->data['Historialpushusuario']['usuario_id'] = $key['Usuario']['id'];
												$this->request->data['Historialpushusuario']['titulo']     = "Estadisticas whatsapp";
												$this->request->data['Historialpushusuario']['texto']      = $estadistica;
					                			$this->Historialpushusuario->create();
					                			$this->Historialpushusuario->save($this->request->data);
												$token = Configure::read('firebase');
												$telefono_whatsapp = $key_asistente['Mycar']['codigo_pais'].$key_asistente['Mycar']['telefono'];
												$toke_bearer = "EAAiivsSmhzwBAElcqIMaalFSFU2YvL55uw1yjolW0hSgSBJdWxys4uZCa4XtFZCCU22JZBM2AaAyswDRQpXzUpuCiiqo3NVWD0TJK39Af2ZBWAOC5EQj5dzJikCGG5diorZAcw7mi9cc5iv3ffeIhaeEMbtpradNGX8A0lZCD2jhnohpCcN5nR90YgWQ0rVIf2LoUoCEudnAZDZD";
												$headers = [
									                'Content-Type: application/json; charset=utf-8;',
									                'Authorization: Bearer '.$toke_bearer 
									            ];
									            $data_w = [
									                'to'   => $telefono_whatsapp,
									                "type" => 'text',
									                "messaging_product"=> "whatsapp",
									                "text"  => array('body'=>$estadistica )
									            ];
												//Whatsapp id de Olympus Bussines whatsapp
										    	$whatsapp_id="104823082639201"; 
										    	$ch = curl_init();
									            curl_setopt( $ch,CURLOPT_URL, 'https://graph.facebook.com/v17.0/'.$whatsapp_id.'/messages' );
									            curl_setopt( $ch,CURLOPT_POST, true );
									            curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
									            curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
									            curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
									            curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $data_w ));
									            curl_setopt($ch, CURLOPT_FAILONERROR, TRUE);
									            $response2 = json_decode(curl_exec($ch));
												curl_close($ch);
									}//fin foreach

				}//fin foreach
				$this->Flash->success(__('Mensaje de whatsapp enviados'));
				return $this->redirect(array('controller' => 'principal', 'action' => 'index'));
			} else {
				$this->Flash->error(__('Registro no Guardado. Por favor, inténtelo de nuevo.'));
			}
		}
	}





}//fin class





