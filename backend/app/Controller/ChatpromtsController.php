<?php
App::uses('AppController', 'Controller');
/**
 * Chatpromts Controller
 *
 * @property Chatpromt $Chatpromt
 * @property PaginatorComponent $Paginator
 * @property FlashComponent $Flash
 * @property SessionComponent $Session
 */
class ChatpromtsController extends AppController {

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
		$this->checkSession(6);
	}

/**
 * index method
 *
 * @return void
 */
	public function index() {
     	  $usuario_rol      = $this->Session->read('usuario_rol');
     	  $usuario_id       = $this->Session->read('usuario_id');
          $this->set('chatpromts', $this->Chatpromt->find('all', array('conditions'=>array('Chatpromt.activo'=>1))));
     	
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
		if (!$this->Chatpromt->exists($id)) {
			throw new NotFoundException(__('Invalid chatpromt'));
		}
		$options = array('conditions' => array('Chatpromt.' . $this->Chatpromt->primaryKey => $id));
		$this->set('chatpromt', $this->Chatpromt->find('first', $options));
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
			$this->Chatpromt->create();
			if ($this->Chatpromt->save($this->request->data)) {
				$this->Flash->success(__('Registro Guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('Registro no Guardado. Por favor, inténtelo de nuevo.'));
			}
		}
		$chatcategorias = $this->Chatpromt->Chatcategoria->find('list');
		$this->set(compact('chatcategorias'));
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
		if (!$this->Chatpromt->exists($id)) {
			throw new NotFoundException(__('Invalid chatpromt'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Chatpromt->save($this->request->data)) {
				$this->Flash->success(__('Registro Guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('Registro no Guardado. Por favor, inténtelo de nuevo.'));
			}
		} else {
			$options = array('conditions' => array('Chatpromt.' . $this->Chatpromt->primaryKey => $id));
			$this->request->data = $this->Chatpromt->find('first', $options);
		}
		$chatcategorias = $this->Chatpromt->Chatcategoria->find('list');
		$this->set(compact('chatcategorias'));
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
        $this->request->data['Chatpromt']['id']     = $id;
	    $this->request->data['Chatpromt']['activo'] = 2;
	    $this->Chatpromt->save($this->request->data);
	}
}
