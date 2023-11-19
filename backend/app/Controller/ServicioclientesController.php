<?php
App::uses('AppController', 'Controller');
/**
 * Servicioclientes Controller
 *
 * @property Serviciocliente $Serviciocliente
 * @property PaginatorComponent $Paginator
 * @property FlashComponent $Flash
 * @property SessionComponent $Session
 */
class ServicioclientesController extends AppController {

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
		$this->checkSession(1);
	}

/**
 * index method
 *
 * @return void
 */
	public function index() {
     	  $usuario_rol      = $this->Session->read('usuario_rol');
     	  $usuario_id       = $this->Session->read('usuario_id');
          $this->set('servicioclientes', $this->Serviciocliente->find('all', array('conditions'=>array('Serviciocliente.activo'=>1))));
     	
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
		if (!$this->Serviciocliente->exists($id)) {
			throw new NotFoundException(__('Invalid serviciocliente'));
		}
		$options = array('conditions' => array('Serviciocliente.' . $this->Serviciocliente->primaryKey => $id));
		$this->set('serviciocliente', $this->Serviciocliente->find('first', $options));
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
			$this->Serviciocliente->create();
			if ($this->Serviciocliente->save($this->request->data)) {
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
		if (!$this->Serviciocliente->exists($id)) {
			throw new NotFoundException(__('Invalid serviciocliente'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Serviciocliente->save($this->request->data)) {
				$this->Flash->success(__('Registro Guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('Registro no Guardado. Por favor, inténtelo de nuevo.'));
			}
		} else {
			$options = array('conditions' => array('Serviciocliente.' . $this->Serviciocliente->primaryKey => $id));
			$this->request->data = $this->Serviciocliente->find('first', $options);
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
        $this->request->data['Serviciocliente']['id']     = $id;
	    $this->request->data['Serviciocliente']['activo'] = 2;
	    $this->Serviciocliente->save($this->request->data);
	}
}
