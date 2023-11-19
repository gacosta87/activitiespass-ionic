<?php
App::uses('AppController', 'Controller');
/**
 * Mycarstips Controller
 *
 * @property Mycarstip $Mycarstip
 * @property PaginatorComponent $Paginator
 * @property FlashComponent $Flash
 * @property SessionComponent $Session
 */
class MycarstipsController extends AppController {

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
		$this->checkSession(5);
	}

/**
 * index method
 *
 * @return void
 */
	public function index() {
     	  $usuario_rol      = $this->Session->read('usuario_rol');
     	  $usuario_id       = $this->Session->read('usuario_id');
          $this->set('mycarstips', $this->Mycarstip->find('all', array('conditions'=>array('Mycarstip.activo'=>1))));
     	
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
		if (!$this->Mycarstip->exists($id)) {
			throw new NotFoundException(__('Invalid mycarstip'));
		}
		$options = array('conditions' => array('Mycarstip.' . $this->Mycarstip->primaryKey => $id));
		$this->set('mycarstip', $this->Mycarstip->find('first', $options));
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
			$datos = $this->request->data['Mycarstip']['url'];
			if(!empty($datos)){
					$imageName = $datos['name']."_".time().'.png';
					$dir = basename("upload")."/".$imageName;
					move_uploaded_file($datos['tmp_name'], $dir);
					$this->request->data['Mycarstip']['url'] = $dir;
			}else{
				$this->request->data['Mycarstip']['url'] = "";
			}
			$datos = $this->request->data['Mycarstip']['imagen'];
			if(!empty($datos)){
					$imageName = $datos['name']."_".time().'.png';
					$dir = basename("upload")."/".$imageName;
					move_uploaded_file($datos['tmp_name'], $dir);
					$this->request->data['Mycarstip']['imagen'] = $dir;
			}else{
				$this->request->data['Mycarstip']['imagen'] = "";
			}
			$this->Mycarstip->create();
			if ($this->Mycarstip->save($this->request->data)) {
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
		if (!$this->Mycarstip->exists($id)) {
			throw new NotFoundException(__('Invalid mycarstip'));
		}
		if ($this->request->is(array('post', 'put'))) {
			$datos = $this->request->data['Beautip']['url'];
			if(!empty($datos) && $datos['name']!=""){
					$imageName = $datos['name']."_".time().'.png';
					$dir = basename("upload")."/".$imageName;
					move_uploaded_file($datos['tmp_name'], $dir);
					$this->request->data['Beautip']['url'] = $dir;
			}else{
				unset($this->request->data['Beautip']['url']);
			}

			$datos = $this->request->data['Beautip']['imagen'];
			if(!empty($datos) && $datos['name']!=""){
					$imageName = $datos['name']."_".time().'.png';
					$dir = basename("upload")."/".$imageName;
					move_uploaded_file($datos['tmp_name'], $dir);
					$this->request->data['Beautip']['imagen'] = $dir;
			}else{
				unset($this->request->data['Beautip']['imagen']);
			}
			
			if ($this->Mycarstip->save($this->request->data)) {
				$this->Flash->success(__('Registro Guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('Registro no Guardado. Por favor, inténtelo de nuevo.'));
			}
		} else {
			$options = array('conditions' => array('Mycarstip.' . $this->Mycarstip->primaryKey => $id));
			$this->request->data = $this->Mycarstip->find('first', $options);
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
        $this->request->data['Mycarstip']['id']     = $id;
	    $this->request->data['Mycarstip']['activo'] = 2;
	    $this->Mycarstip->save($this->request->data);
	}
}
