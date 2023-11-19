<?php
App::uses('AppController', 'Controller');
/**
 * Paraticategorias Controller
 *
 * @property Paraticategoria $Paraticategoria
 * @property PaginatorComponent $Paginator
 * @property FlashComponent $Flash
 * @property SessionComponent $Session
 */
class ParaticategoriasController extends AppController {

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
		$this->checkSession(8);
	}

/**
 * index method
 *
 * @return void
 */
	public function index() {
     	  $usuario_rol      = $this->Session->read('usuario_rol');
     	  $usuario_id       = $this->Session->read('usuario_id');
          $this->set('paraticategorias', $this->Paraticategoria->find('all', array('conditions'=>array('Paraticategoria.activo'=>1))));
     	
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
		if (!$this->Paraticategoria->exists($id)) {
			throw new NotFoundException(__('Invalid paraticategoria'));
		}
		$options = array('conditions' => array('Paraticategoria.' . $this->Paraticategoria->primaryKey => $id));
		$this->set('paraticategoria', $this->Paraticategoria->find('first', $options));
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
			$this->Paraticategoria->create();
			$datos = $this->request->data['Paraticategoria']['url_imagen'];
			if(!empty($datos)){
					$imageName = $datos['name']."_".time().'.png';
					$dir = basename("upload")."/".$imageName;
					move_uploaded_file($datos['tmp_name'], $dir);
					$this->request->data['Paraticategoria']['url_imagen'] = $dir;
			}else{
				$this->request->data['Paraticategoria']['url_imagen'] = "";
			}
			if ($this->Paraticategoria->save($this->request->data)) {
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
		if (!$this->Paraticategoria->exists($id)) {
			throw new NotFoundException(__('Invalid paraticategoria'));
		}
		if ($this->request->is(array('post', 'put'))) {
			$datos = $this->request->data['Paraticategoria']['url_imagen'];
			if(!empty($datos) && $datos['name']!=""){
					$imageName = $datos['name']."_".time().'.png';
					$dir = basename("upload")."/".$imageName;
					move_uploaded_file($datos['tmp_name'], $dir);
					$this->request->data['Paraticategoria']['url_imagen'] = $dir;
			}else{
				unset($this->request->data['Paraticategoria']['url_imagen']);
			}
			if ($this->Paraticategoria->save($this->request->data)) {
				$this->Flash->success(__('Registro Guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('Registro no Guardado. Por favor, inténtelo de nuevo.'));
			}
		} else {
			$options = array('conditions' => array('Paraticategoria.' . $this->Paraticategoria->primaryKey => $id));
			$this->request->data = $this->Paraticategoria->find('first', $options);
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
        $this->request->data['Paraticategoria']['id']     = $id;
	    $this->request->data['Paraticategoria']['activo'] = 2;
	    $this->Paraticategoria->save($this->request->data);
	}
}
