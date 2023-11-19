<?php
App::uses('AppController', 'Controller');
/**
 * Mycartipos Controller
 *
 * @property Mycartipo $Mycartipo
 * @property PaginatorComponent $Paginator
 * @property FlashComponent $Flash
 * @property SessionComponent $Session
 */
class MycartiposController extends AppController {

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
		$this->checkSession(3);
	}

/**
 * index method
 *
 * @return void
 */
	public function index() {
     	  $usuario_rol      = $this->Session->read('usuario_rol');
     	  $usuario_id       = $this->Session->read('usuario_id');
          $this->set('mycartipos', $this->Mycartipo->find('all', array('conditions'=>array('Mycartipo.activo'=>1))));
     	
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
		if (!$this->Mycartipo->exists($id)) {
			throw new NotFoundException(__('Invalid mycartipo'));
		}
		$options = array('conditions' => array('Mycartipo.' . $this->Mycartipo->primaryKey => $id));
		$this->set('mycartipo', $this->Mycartipo->find('first', $options));
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
			$this->Mycartipo->create();

			$datos = $this->request->data['Mycartipo']['imagen'];
			if(!empty($datos)){
					$imageName = $datos['name']."_".time().'.png';
					$dir = basename("upload")."/".$imageName;
					move_uploaded_file($datos['tmp_name'], $dir);
					$this->request->data['Mycartipo']['imagen'] = $dir;
			}else{
				$this->request->data['Mycartipo']['imagen'] = "";
			}

			if ($this->Mycartipo->save($this->request->data)) {
				$this->Flash->success(__('Registro Guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('Registro no Guardado. Por favor, inténtelo de nuevo.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
	    $usuario_rol      = $this->Session->read('usuario_rol');
     	$usuario_id       = $this->Session->read('usuario_id');
		if (!$this->Mycartipo->exists($id)) {
			throw new NotFoundException(__('Invalid mycartipo'));
		}
		if ($this->request->is(array('post', 'put'))) {
			$datos = $this->request->data['Mycartipo']['imagen'];
			if(!empty($datos) && $datos['name']!=""){
					$imageName = $datos['name']."_".time().'.png';
					$dir = basename("upload")."/".$imageName;
					move_uploaded_file($datos['tmp_name'], $dir);
					$this->request->data['Mycartipo']['imagen'] = $dir;
			}else{
				unset($this->request->data['Mycartipo']['imagen']);
			}
			if ($this->Mycartipo->save($this->request->data)) {
				$this->Flash->success(__('Registro Guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('Registro no Guardado. Por favor, inténtelo de nuevo.'));
			}
		} else {
			$options = array('conditions' => array('Mycartipo.' . $this->Mycartipo->primaryKey => $id));
			$this->request->data = $this->Mycartipo->find('first', $options);
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
        $this->request->data['Mycartipo']['id']     = $id;
	    $this->request->data['Mycartipo']['activo'] = 2;
	}
}
