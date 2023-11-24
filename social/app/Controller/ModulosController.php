<?php
App::uses('AppController', 'Controller');
/**
 * Modulos Controller
 *
 * @property Modulo $Modulo
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class ModulosController extends AppController {

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
		$this->checkSession(1);
	}

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Modulo->recursive = 0;
		$this->set('modulos', $this->Paginator->paginate());
		//$this->set('modulos', $this->Modulo->find('all'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Modulo->exists($id)) {
			throw new NotFoundException(__('Invalid modulo'));
		}
		$options = array('conditions' => array('Modulo.' . $this->Modulo->primaryKey => $id));
		$this->set('modulo', $this->Modulo->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Modulo->create();
			if ($this->Modulo->save($this->request->data)) {
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
		if (!$this->Modulo->exists($id)) {
			throw new NotFoundException(__('Invalid modulo'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Modulo->save($this->request->data)) {
				$this->Flash->success(__('Registro Guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('Registro no Guardado. Por favor, inténtelo de nuevo.'));
			}
		} else {
			$options = array('conditions' => array('Modulo.' . $this->Modulo->primaryKey => $id));
			$this->request->data = $this->Modulo->find('first', $options);
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
		$this->Modulo->id = $id;
		if (!$this->Modulo->exists()) {
			throw new NotFoundException(__('Invalid modulo'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Modulo->delete()) {
			$this->Flash->success(__('El Registro fue eliminado.'));
		} else {
			$this->Flash->error(__('El Registro no fue eliminado. Por favor, inténtelo de nuevo.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
