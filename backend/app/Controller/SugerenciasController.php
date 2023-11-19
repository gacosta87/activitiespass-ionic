<?php
App::uses('AppController', 'Controller');
/**
 * Sugerencias Controller
 *
 * @property Sugerencia $Sugerencia
 * @property PaginatorComponent $Paginator
 * @property FlashComponent $Flash
 * @property SessionComponent $Session
 */
class SugerenciasController extends AppController {

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
		$this->checkSession(7);
	}

/**
 * index method
 *
 * @return void
 */
	public function index() {
     	  $usuario_rol      = $this->Session->read('usuario_rol');
     	  $usuario_id       = $this->Session->read('usuario_id');
          $this->set('sugerencias', $this->Sugerencia->find('all', array('conditions'=>array('Sugerencia.activo'=>1))));
     	
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
		if (!$this->Sugerencia->exists($id)) {
			throw new NotFoundException(__('Invalid sugerencia'));
		}
		$options = array('conditions' => array('Sugerencia.' . $this->Sugerencia->primaryKey => $id));
		$this->set('sugerencia', $this->Sugerencia->find('first', $options));
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
			$this->Sugerencia->create();
			if ($this->Sugerencia->save($this->request->data)) {
				$this->Flash->success(__('Registro Guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('Registro no Guardado. Por favor, inténtelo de nuevo.'));
			}
		}
		$usuarios = $this->Sugerencia->Usuario->find('list');
		$this->set(compact('usuarios'));
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
		if (!$this->Sugerencia->exists($id)) {
			throw new NotFoundException(__('Invalid sugerencia'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Sugerencia->save($this->request->data)) {
				$this->Flash->success(__('Registro Guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('Registro no Guardado. Por favor, inténtelo de nuevo.'));
			}
		} else {
			$options = array('conditions' => array('Sugerencia.' . $this->Sugerencia->primaryKey => $id));
			$this->request->data = $this->Sugerencia->find('first', $options);
		}
		$usuarios = $this->Sugerencia->Usuario->find('list');
		$this->set(compact('usuarios'));
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
        $this->request->data['Sugerencia']['id']     = $id;
	    $this->request->data['Sugerencia']['activo'] = 2;
	    $this->Sugerencia->save($this->request->data);
	}
}
