<?php
App::uses('AppController', 'Controller');
/**
 * Roles Controller
 *
 * @property Role $Role
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class RolesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session', 'Flash');

	var $uses = array('Role', 'Rolesmodulo');
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
		$this->Role->recursive = 0;
		$this->set('roles', $this->Paginator->paginate());
		//$this->set('roles', $this->Role->find('all'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Role->exists($id)) {
			throw new NotFoundException(__('Invalid role'));
		}
		$options = array('conditions' => array('Role.' . $this->Role->primaryKey => $id));
		$this->set('role', $this->Role->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Role->create();
			if ($this->Role->save($this->request->data)) {
				$id   =  $this->Role->id;
				$stop = 0;
				if(!empty($this->request->data["Afiliado"]["Modulos"])){
					foreach($this->request->data["Afiliado"]["Modulos"] as $modulo){
						$this->request->data["Rolesmodulo"]["role_id"]   = $id;
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
			} else {
				$this->Flash->error(__('Registro no Guardado. Por favor, inténtelo de nuevo.'));
			}
		}
		$modulos = $this->Rolesmodulo->Modulo->find('all');
		$this->set(compact('modulos'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Role->exists($id)) {
			throw new NotFoundException(__('Invalid role'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Role->save($this->request->data)) {
				$this->Rolesmodulo->deleteAll(array('Rolesmodulo.role_id'=>$id));
				$stop = 0;
				if(!empty($this->request->data["Afiliado"]["Modulos"])){
					foreach($this->request->data["Afiliado"]["Modulos"] as $modulo){
						$this->request->data["Rolesmodulo"]["role_id"]   = $id;
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
			} else {
				$this->Flash->error(__('Registro no Guardado. Por favor, inténtelo de nuevo.'));
			}
		} else {
			$options = array('conditions' => array('Role.' . $this->Role->primaryKey => $id));
			$this->request->data = $this->Role->find('first', $options);
		}
		$rolesmodulos = $this->Rolesmodulo->find('all', array('conditions'=>array('role_id'=>$id)));
		$modulos        = $this->Rolesmodulo->Modulo->find('all');
		$this->set(compact('modulos', 'rolesmodulos'));
	}
/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Role->id = $id;
		if (!$this->Role->exists()) {
			throw new NotFoundException(__('Invalid role'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Role->delete()) {
			$this->Flash->success(__('El Registro fue eliminado.'));
		} else {
			$this->Flash->error(__('El Registro no fue eliminado. Por favor, inténtelo de nuevo.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
