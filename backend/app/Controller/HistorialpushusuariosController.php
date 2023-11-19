<?php
App::uses('AppController', 'Controller');
/**
 * Historialpushusuarios Controller
 *
 * @property Historialpushusuario $Historialpushusuario
 * @property PaginatorComponent $Paginator
 * @property FlashComponent $Flash
 * @property SessionComponent $Session
 */
class HistorialpushusuariosController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Flash', 'Session');

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
          $this->set('historialpushusuarios', $this->Historialpushusuario->find('all', array('conditions'=>array('Historialpushusuario.activo'=>1))));
     	
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
		if (!$this->Historialpushusuario->exists($id)) {
			throw new NotFoundException(__('Invalid historialpushusuario'));
		}
		$options = array('conditions' => array('Historialpushusuario.' . $this->Historialpushusuario->primaryKey => $id));
		$this->set('historialpushusuario', $this->Historialpushusuario->find('first', $options));
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
			$this->Historialpushusuario->create();
			if ($this->Historialpushusuario->save($this->request->data)) {
				$Usuarios = $this->Historialpushusuario->Usuario->find('all', array('conditions'=>array('Usuario.id'=>$this->request->data['Historialpushusuario']['usuario_id'])));
                foreach ($Usuarios as $key) {
							$token = Configure::read('firebase');
							$not   = "";//"DATABASE OBJECT NOTIFICATION";platform
							//Datos/
							$to_android = $key['Usuario']['push_token'];//$usuario[0]['User']['push_token'];//Datos del usuario
							$to_ios     = $key['Usuario']['push_token'];//$usuario[0]['User']['push_token'];//Datos del usuario
							$platform   = $key['Usuario']['push_platf'];//Datos del usuario
							$titulo     = $this->request->data['Historialpushusuario']['titulo'];
							$mensaje    = $this->request->data['Historialpushusuario']['texto'];
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
		$usuarios = $this->Historialpushusuario->Usuario->find('list');
		$this->set(compact('usuarios'));
	}


}
