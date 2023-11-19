<?php
App::uses('AppController', 'Controller');
/**
 * Publicidades Controller
 *
 * @property Publicidade $Publicidade
 * @property PaginatorComponent $Paginator
 * @property FlashComponent $Flash
 * @property SessionComponent $Session
 */
class PublicidadesController extends AppController {

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
		$this->checkSession(1);
	}

/**
 * index method
 *
 * @return void
 */
	public function index() {
     	  $usuario_rol      = $this->Session->read('usuario_rol');
     	  $usuario_id       = $this->Session->read('usuario_id');
          $this->set('publicidades', $this->Publicidade->find('all', array('conditions'=>array('Publicidade.activo'=>1))));
     	
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
		if (!$this->Publicidade->exists($id)) {
			throw new NotFoundException(__('Invalid publicidade'));
		}
		$options = array('conditions' => array('Publicidade.' . $this->Publicidade->primaryKey => $id));
		$this->set('publicidade', $this->Publicidade->find('first', $options));
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
			$this->Publicidade->create();
			$datos = $this->request->data['Publicidade']['imagen'];
			if(!empty($datos)){
					$imageName = $datos['name']."_".time().'.png';
					$dir = basename("upload")."/".$imageName;
					move_uploaded_file($datos['tmp_name'], $dir);
					$this->request->data['Publicidade']['imagen'] = $dir;
			}else{
				$this->request->data['Publicidade']['imagen'] = "";
			}
			if ($this->Publicidade->save($this->request->data)) {
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
		if (!$this->Publicidade->exists($id)) {
			throw new NotFoundException(__('Invalid publicidade'));
		}
		if ($this->request->is(array('post', 'put'))) {
			$datos = $this->request->data['Publicidade']['imagen'];
			if(!empty($datos) && $datos['name']!=""){
					$imageName = $datos['name']."_".time().'.png';
					$dir = basename("upload")."/".$imageName;
					move_uploaded_file($datos['tmp_name'], $dir);
					$this->request->data['Publicidade']['imagen'] = $dir;
			}else{
				unset($this->request->data['Publicidade']['imagen']);
			}
			if ($this->Publicidade->save($this->request->data)) {
				$this->Flash->success(__('Registro Guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('Registro no Guardado. Por favor, inténtelo de nuevo.'));
			}
		} else {
			$options = array('conditions' => array('Publicidade.' . $this->Publicidade->primaryKey => $id));
			$this->request->data = $this->Publicidade->find('first', $options);
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
        $this->request->data['Publicidade']['id']     = $id;
	    $this->request->data['Publicidade']['activo'] = 2;
	    $this->Publicidade->save($this->request->data);
	}
}
