<?php
App::uses('AppController', 'Controller');
/**
 * Chatcategorias Controller
 *
 * @property Chatcategoria $Chatcategoria
 * @property PaginatorComponent $Paginator
 * @property FlashComponent $Flash
 * @property SessionComponent $Session
 */
class ChatcategoriasController extends AppController {

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
		$this->checkSession(6);
	}

/**
 * index method
 *
 * @return void
 */
	public function index() {
     	  $usuario_rol      = $this->Session->read('usuario_rol');
     	  $usuario_id       = $this->Session->read('usuario_id');
          $this->set('chatcategorias', $this->Chatcategoria->find('all', array('conditions'=>array('Chatcategoria.activo'=>1))));
     	
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
		if (!$this->Chatcategoria->exists($id)) {
			throw new NotFoundException(__('Invalid chatcategoria'));
		}
		$options = array('conditions' => array('Chatcategoria.' . $this->Chatcategoria->primaryKey => $id));
		$this->set('chatcategoria', $this->Chatcategoria->find('first', $options));
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
			$this->Chatcategoria->create();
			$datos = $this->request->data['Chatcategoria']['url_imagen'];
			if(!empty($datos)){
					$imageName = $datos['name']."_".time().'.png';
					$dir = basename("upload")."/".$imageName;
					move_uploaded_file($datos['tmp_name'], $dir);
					$this->request->data['Chatcategoria']['url_imagen'] = $dir;
			}else{
				$this->request->data['Chatcategoria']['url_imagen'] = "";
			}
			if ($this->Chatcategoria->save($this->request->data)) {
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
		if (!$this->Chatcategoria->exists($id)) {
			throw new NotFoundException(__('Invalid chatcategoria'));
		}
		if ($this->request->is(array('post', 'put'))) {
			$datos = $this->request->data['Chatcategoria']['url_imagen'];
			if(!empty($datos) && $datos['name']!=""){
					$imageName = $datos['name']."_".time().'.png';
					$dir = basename("upload")."/".$imageName;
					move_uploaded_file($datos['tmp_name'], $dir);
					$this->request->data['Chatcategoria']['url_imagen'] = $dir;
			}else{
				unset($this->request->data['Chatcategoria']['url_imagen']);
			}
			if ($this->Chatcategoria->save($this->request->data)) {
				$this->Flash->success(__('Registro Guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('Registro no Guardado. Por favor, inténtelo de nuevo.'));
			}
		} else {
			$options = array('conditions' => array('Chatcategoria.' . $this->Chatcategoria->primaryKey => $id));
			$this->request->data = $this->Chatcategoria->find('first', $options);
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
        $this->request->data['Chatcategoria']['id']     = $id;
	    $this->request->data['Chatcategoria']['activo'] = 2;
	    $this->Chatcategoria->save($this->request->data);
	}
}
