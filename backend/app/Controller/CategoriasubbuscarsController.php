<?php
App::uses('AppController', 'Controller');
/**
 * Categoriasubbuscars Controller
 *
 * @property Categoriasubbuscar $Categoriasubbuscar
 * @property PaginatorComponent $Paginator
 * @property FlashComponent $Flash
 * @property SessionComponent $Session
 */
class CategoriasubbuscarsController extends AppController {

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
          $this->set('categoriasubbuscars', $this->Categoriasubbuscar->find('all', array('conditions'=>array('Categoriasubbuscar.activo'=>1))));
     	
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
		if (!$this->Categoriasubbuscar->exists($id)) {
			throw new NotFoundException(__('Invalid categoriasubbuscar'));
		}
		$options = array('conditions' => array('Categoriasubbuscar.' . $this->Categoriasubbuscar->primaryKey => $id));
		$this->set('categoriasubbuscar', $this->Categoriasubbuscar->find('first', $options));
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
			$this->Categoriasubbuscar->create();
			if ($this->Categoriasubbuscar->save($this->request->data)) {
				$this->Flash->success(__('Registro Guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('Registro no Guardado. Por favor, inténtelo de nuevo.'));
			}
		}
		$categorias = $this->Categoriasubbuscar->Categoria->find('list', array('conditions'=>array('Categoria.activo'=>1)));
		$categoriasubs = array();
		$this->set(compact('categorias', 'categoriasubs'));
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
		if (!$this->Categoriasubbuscar->exists($id)) {
			throw new NotFoundException(__('Invalid categoriasubbuscar'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Categoriasubbuscar->save($this->request->data)) {
				$this->Flash->success(__('Registro Guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('Registro no Guardado. Por favor, inténtelo de nuevo.'));
			}
		} else {
			$options = array('conditions' => array('Categoriasubbuscar.' . $this->Categoriasubbuscar->primaryKey => $id));
			$this->request->data = $this->Categoriasubbuscar->find('first', $options);
		}
		$categorias = $this->Categoriasubbuscar->Categoria->find('list', array('conditions'=>array('Categoria.activo'=>1)));
		$categoriasubs = $this->Categoriasubbuscar->Categoriasub->find('list', array('conditions'=>array('Categoriasub.categoria_id'=>$this->request->data['Categoriasubbuscar']['categoria_id'], 'Categoriasub.activo'=>1)));
		$this->set(compact('categorias', 'categoriasubs'));
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
        $this->request->data['Categoriasubbuscar']['id']     = $id;
	    $this->request->data['Categoriasubbuscar']['activo'] = 2;
	}

	public function categoriasub($id=null) {
		$this->layout="ajax";
		$categoriasubs = $this->Categoriasubbuscar->Categoriasub->find('list', array('conditions'=>array('Categoriasub.categoria_id'=>$id, 'Categoriasub.activo'=>1)));
		$this->set('categoriasubs', $categoriasubs);
	}
}
