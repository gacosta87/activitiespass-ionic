<?php
App::uses('AppController', 'Controller');
/**
 * Categorias Controller
 *
 * @property Categoria $Categoria
 * @property PaginatorComponent $Paginator
 * @property FlashComponent $Flash
 * @property SessionComponent $Session
 */
class CategoriasController extends AppController {

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
          $this->set('categorias', $this->Categoria->find('all', array('conditions'=>array('Categoria.activo'=>1))));
     	
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
		if (!$this->Categoria->exists($id)) {
			throw new NotFoundException(__('Invalid categoria'));
		}
		$options = array('conditions' => array('Categoria.' . $this->Categoria->primaryKey => $id));
		$this->set('categoria', $this->Categoria->find('first', $options));
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
			$this->Categoria->create();
			$datos = $this->request->data['Categoria']['imagen'];
			if(!empty($datos)){
					$imageName = $datos['name']."_".time().'.png';
					$dir = basename("upload")."/".$imageName;
					move_uploaded_file($datos['tmp_name'], $dir);
					$this->request->data['Categoria']['imagen'] = $dir;
			}else{
				$this->request->data['Categoria']['imagen'] = "";
			}
			if ($this->Categoria->save($this->request->data)) {
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
		if (!$this->Categoria->exists($id)) {
			throw new NotFoundException(__('Invalid categoria'));
		}
		if ($this->request->is(array('post', 'put'))) {
			$datos = $this->request->data['Categoria']['imagen'];
			if(!empty($datos) && $datos['name']!=""){
					$imageName = $datos['name']."_".time().'.png';
					$dir = basename("upload")."/".$imageName;
					move_uploaded_file($datos['tmp_name'], $dir);
					$this->request->data['Categoria']['imagen'] = $dir;
			}else{
				unset($this->request->data['Categoria']['imagen']);
			}
			if ($this->Categoria->save($this->request->data)) {
				$this->Flash->success(__('Registro Guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('Registro no Guardado. Por favor, inténtelo de nuevo.'));
			}
		} else {
			$options = array('conditions' => array('Categoria.' . $this->Categoria->primaryKey => $id));
			$this->request->data = $this->Categoria->find('first', $options);
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
        $this->request->data['Categoria']['id']     = $id;
	    $this->request->data['Categoria']['activo'] = 2;
	}
}
