<?php
App::uses('AppController', 'Controller');
/**
 * Asistentechatsredes Controller
 *
 * @property Asistentechatsrede $Asistentechatsrede
 * @property PaginatorComponent $Paginator
 * @property FlashComponent $Flash
 * @property SessionComponent $Session
 */
class AsistentechatsredesController extends AppController {

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
		$this->checkSession();
	}

/**
 * index method
 *
 * @return void
 */
	public function index() {
     	  $usuario_rol      = $this->Session->read('usuario_rol');
     	  $usuario_id       = $this->Session->read('usuario_id');
          $this->set('asistentechatsredes', $this->Asistentechatsrede->find('all', array('conditions'=>array('Asistentechatsrede.activo'=>array(1,3), 'Asistentechatsrede.fields'=>'Whatsapp'))));
     	
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
		if (!$this->Asistentechatsrede->exists($id)) {
			throw new NotFoundException(__('Invalid asistentechatsrede'));
		}
		$options = array('conditions' => array('Asistentechatsrede.' . $this->Asistentechatsrede->primaryKey => $id));
		$this->set('asistentechatsrede', $this->Asistentechatsrede->find('first', $options));
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
			$this->Asistentechatsrede->create();
			if ($this->Asistentechatsrede->save($this->request->data)) {
				$this->Flash->success(__('Registro Guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('Registro no Guardado. Por favor, inténtelo de nuevo.'));
			}
		}
		$senders = array();
		$recipients = array();
		$mensajes = $this->Asistentechatsrede->Mensaje->find('list');
		$this->set(compact('senders', 'recipients', 'mensajes'));
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
		if (!$this->Asistentechatsrede->exists($id)) {
			throw new NotFoundException(__('Invalid asistentechatsrede'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Asistentechatsrede->save($this->request->data)) {
				$this->Flash->success(__('Registro Guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('Registro no Guardado. Por favor, inténtelo de nuevo.'));
			}
		} else {
			$options = array('conditions' => array('Asistentechatsrede.' . $this->Asistentechatsrede->primaryKey => $id));
			$this->request->data = $this->Asistentechatsrede->find('first', $options);
		}
		$senders = array();
		$recipients = array();
		$mensajes = $this->Asistentechatsrede->Mensaje->find('list');
		$this->set(compact('senders', 'recipients', 'mensajes'));
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
        $this->request->data['Asistentechatsrede']['id']     = $id;
	    $this->request->data['Asistentechatsrede']['activo'] = 2;
	    $this->Asistentechatsrede->save($this->request->data);
	}
}
