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
class CategoriasubsController extends AppController {

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
          $this->set('categoriasubs', $this->Categoriasub->find('all', array('conditions'=>array('Categoriasub.activo'=>1))));
     	
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
		if (!$this->Categoriasub->exists($id)) {
			throw new NotFoundException(__('Invalid categoriasub'));
		}
		$options = array('conditions' => array('Categoriasub.' . $this->Categoriasub->primaryKey => $id));
		$this->set('categoriasub', $this->Categoriasub->find('first', $options));
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
			$this->Categoriasub->create();
			$datos = $this->request->data['Categoriasub']['imagen'];
			if(!empty($datos)){
					$imageName = $datos['name']."_".time().'.png';
					$dir = basename("upload")."/".$imageName;
					move_uploaded_file($datos['tmp_name'], $dir);
					$this->request->data['Categoriasub']['imagen'] = $dir;
			}else{
				$this->request->data['Categoriasub']['imagen'] = "";
			}
			if ($this->Categoriasub->save($this->request->data)) {
				$this->Flash->success(__('Registro Guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('Registro no Guardado. Por favor, inténtelo de nuevo.'));
			}
		}
		$categorias = $this->Categoriasub->Categoria->find('list', array('conditions'=>array('Categoria.activo'=>1)));
		$this->set(compact('categorias'));
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
		if (!$this->Categoriasub->exists($id)) {
			throw new NotFoundException(__('Invalid categoriasub'));
		}
		if ($this->request->is(array('post', 'put'))) {
			$datos = $this->request->data['Categoriasub']['imagen'];
			if(!empty($datos) && $datos['name']!=""){
					$imageName = $datos['name']."_".time().'.png';
					$dir = basename("upload")."/".$imageName;
					move_uploaded_file($datos['tmp_name'], $dir);
					$this->request->data['Categoriasub']['imagen'] = $dir;
			}else{
				unset($this->request->data['Categoriasub']['imagen']);
			}
			if ($this->Categoriasub->save($this->request->data)) {
				$this->Flash->success(__('Registro Guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('Registro no Guardado. Por favor, inténtelo de nuevo.'));
			}
		} else {
			$options = array('conditions' => array('Categoriasub.' . $this->Categoriasub->primaryKey => $id));
			$this->request->data = $this->Categoriasub->find('first', $options);
		}
		$categorias = $this->Categoriasub->Categoria->find('list', array('conditions'=>array('Categoria.activo'=>1)));
		$this->set(compact('categorias'));
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
        $this->request->data['Categoriasub']['id']     = $id;
	    $this->request->data['Categoriasub']['activo'] = 2;
	}
}
