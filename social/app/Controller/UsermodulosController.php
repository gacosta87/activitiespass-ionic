<?php
App::uses('AppController', 'Controller');
/**
 * Usermodulos Controller
 *
 * @property Usermodulo $Usermodulo
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class UsermodulosController extends AppController {

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
		//$this->Usermodulo->recursive = 0;
		//$this->set('usermodulos', $this->Paginator->paginate());
		$this->set('usermodulos', $this->Usermodulo->find('all'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Usermodulo->exists($id)) {
			throw new NotFoundException(__('Invalid usermodulo'));
		}
		$options = array('conditions' => array('Usermodulo.' . $this->Usermodulo->primaryKey => $id));
		$this->set('usermodulo', $this->Usermodulo->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Usermodulo->create();
			if ($this->Usermodulo->save($this->request->data)) {
				$this->Flash->success(__('Registro Guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('Registro no Guardado. Por favor, inténtelo de nuevo.'));
			}
		}
		$users = $this->Usermodulo->User->find('list');
		$modulos = $this->Usermodulo->Modulo->find('list');
		$this->set(compact('users', 'modulos'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Usermodulo->exists($id)) {
			throw new NotFoundException(__('Invalid usermodulo'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Usermodulo->save($this->request->data)) {
				$this->Flash->success(__('Registro Guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('Registro no Guardado. Por favor, inténtelo de nuevo.'));
			}
		} else {
			$options = array('conditions' => array('Usermodulo.' . $this->Usermodulo->primaryKey => $id));
			$this->request->data = $this->Usermodulo->find('first', $options);
		}
		$users = $this->Usermodulo->User->find('list');
		$modulos = $this->Usermodulo->Modulo->find('list');
		$this->set(compact('users', 'modulos'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Usermodulo->id = $id;
		if (!$this->Usermodulo->exists()) {
			throw new NotFoundException(__('Invalid usermodulo'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Usermodulo->delete()) {
			$this->Flash->success(__('El Registro fue eliminado.'));
		} else {
			$this->Flash->error(__('El Registro no fue eliminado. Por favor, inténtelo de nuevo.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
