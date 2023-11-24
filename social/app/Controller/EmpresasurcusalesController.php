<?php
App::uses('AppController', 'Controller');
/**
 * Empresasurcusales Controller
 *
 * @property Empresasurcusale $Empresasurcusale
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class EmpresasurcusalesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session', 'Flash');

/*
** var de layout
*
*/
	public $layout = "dashbord";

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
		//$this->Empresasurcusale->recursive = 0;
		//$this->set('empresasurcusales', $this->Paginator->paginate());
		$empresa_id          = $this->Session->read('empresa_id');
	    $empresasurcusale_id = $this->Session->read('empresasurcusale_id');
		$this->set('empresasurcusales', $this->Empresasurcusale->find('all', array('conditions'=>array('empresa_id'=>$empresa_id))));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Empresasurcusale->exists($id)) {
			throw new NotFoundException(__('Invalid empresasurcusale'));
		}
		$options = array('conditions' => array('Empresasurcusale.' . $this->Empresasurcusale->primaryKey => $id));
		$this->set('empresasurcusale', $this->Empresasurcusale->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$empresa_id          = $this->Session->read('empresa_id');
     	  $empresasurcusale_id = $this->Session->read('empresasurcusale_id');
     	  $rol_id              = $this->Session->read('ROL');
     	  $user_id             = $this->Session->read('USUARIO_ID');
		if ($this->request->is('post')) {
			$this->Empresasurcusale->create();
			if ($this->Empresasurcusale->save($this->request->data)) {
				$this->Flash->success(__('Registro Guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('Registro no Guardado. Por favor, inténtelo de nuevo.'));
			}
		}
		$empresas = $this->Empresasurcusale->Empresa->find('list', array('conditions'=>array('id'=>$empresa_id) ));
      	//$empresas = $this->Empresasurcusale->Empresa->find('list');
		$this->set(compact('empresas'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$empresa_id          = $this->Session->read('empresa_id');
     	  $empresasurcusale_id = $this->Session->read('empresasurcusale_id');
     	  $rol_id              = $this->Session->read('ROL');
     	  $user_id             = $this->Session->read('USUARIO_ID');
		if (!$this->Empresasurcusale->exists($id)) {
			throw new NotFoundException(__('Invalid empresasurcusale'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Empresasurcusale->save($this->request->data)) {
				$this->Flash->success(__('Registro Guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('Registro no Guardado. Por favor, inténtelo de nuevo.'));
			}
		} else {
			$options = array('conditions' => array('Empresasurcusale.' . $this->Empresasurcusale->primaryKey => $id));
			$this->request->data = $this->Empresasurcusale->find('first', $options);
		}
		$empresas = $this->Empresasurcusale->Empresa->find('list', array('conditions'=>array('id'=>$empresa_id) ));
		$this->set(compact('empresas'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Empresasurcusale->id = $id;
		if (!$this->Empresasurcusale->exists()) {
			throw new NotFoundException(__('Invalid empresasurcusale'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Empresasurcusale->delete()) {
			$this->Flash->success(__('El Registro fue eliminado.'));
		} else {
			$this->Flash->error(__('El Registro no fue eliminado. Por favor, inténtelo de nuevo.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
