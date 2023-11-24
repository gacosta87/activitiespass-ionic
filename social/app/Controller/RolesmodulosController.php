<?php
App::uses('AppController', 'Controller');
/**
 * Rolesmodulos Controller
 *
 * @property Rolesmodulo $Rolesmodulo
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class RolesmodulosController extends AppController {

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
		$this->Rolesmodulo->recursive = 0;
		$this->set('rolesmodulos', $this->Paginator->paginate());
		//$this->set('rolesmodulos', $this->Rolesmodulo->find('all'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Rolesmodulo->exists($id)) {
			throw new NotFoundException(__('Invalid rolesmodulo'));
		}
		$options = array('conditions' => array('Rolesmodulo.' . $this->Rolesmodulo->primaryKey => $id));
		$this->set('rolesmodulo', $this->Rolesmodulo->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Rolesmodulo->create();
            $stop = 0;
			if(!empty($this->request->data["Afiliado"]["Modulos"])){
				foreach($this->request->data["Afiliado"]["Modulos"] as $modulo){
					$this->request->data["Rolesmodulo"]["modulo_id"] = $modulo['tipo'];
					$this->Rolesmodulo->create();
					if ($this->Rolesmodulo->save($this->request->data)) {

					}else{
						$stop = 1;
					}

				}
			}
			if ($stop==0) {
				$this->Flash->success(__('Registro Guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('Registro no Guardado. Por favor, inténtelo de nuevo.'));
			}
		}
		$roles = $this->Rolesmodulo->Role->find('list');
		$modulos = $this->Rolesmodulo->Modulo->find('all');
		$this->set(compact('roles', 'modulos'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Rolesmodulo->exists($id)) {
			throw new NotFoundException(__('Invalid rolesmodulo'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Rolesmodulo->save($this->request->data)) {
				$this->Flash->success(__('Registro Guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('Registro no Guardado. Por favor, inténtelo de nuevo.'));
			}
		} else {
			$options = array('conditions' => array('Rolesmodulo.' . $this->Rolesmodulo->primaryKey => $id));
			$this->request->data = $this->Rolesmodulo->find('first', $options);
		}
		$roles = $this->Rolesmodulo->Role->find('list');
		$modulos = $this->Rolesmodulo->Modulo->find('list');
		$this->set(compact('roles', 'modulos'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Rolesmodulo->id = $id;
		if (!$this->Rolesmodulo->exists()) {
			throw new NotFoundException(__('Invalid rolesmodulo'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Rolesmodulo->delete()) {
			$this->Flash->success(__('El Registro fue eliminado.'));
		} else {
			$this->Flash->error(__('El Registro no fue eliminado. Por favor, inténtelo de nuevo.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
