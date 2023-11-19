<?php
App::uses('AppController', 'Controller');
/**
 * Puntuaciones Controller
 *
 * @property Puntuacione $Puntuacione
 * @property PaginatorComponent $Paginator
 * @property FlashComponent $Flash
 * @property SessionComponent $Session
 */
class PuntuacionesController extends AppController {

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
		$this->checkSession(5);
	}

/**
 * index method
 *
 * @return void
 */
	public function index() {
     	  $usuario_rol      = $this->Session->read('usuario_rol');
     	  $usuario_id       = $this->Session->read('usuario_id');
          $this->set('puntuaciones', $this->Puntuacione->find('all', array('conditions'=>array('Puntuacione.activo'=>1))));
     	
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
		if (!$this->Puntuacione->exists($id)) {
			throw new NotFoundException(__('Invalid puntuacione'));
		}
		$options = array('conditions' => array('Puntuacione.' . $this->Puntuacione->primaryKey => $id));
		$this->set('puntuacione', $this->Puntuacione->find('first', $options));
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
			$this->Puntuacione->create();
			if ($this->Puntuacione->save($this->request->data)) {
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
		if (!$this->Puntuacione->exists($id)) {
			throw new NotFoundException(__('Invalid puntuacione'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Puntuacione->save($this->request->data)) {
				$this->Flash->success(__('Registro Guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('Registro no Guardado. Por favor, inténtelo de nuevo.'));
			}
		} else {
			$options = array('conditions' => array('Puntuacione.' . $this->Puntuacione->primaryKey => $id));
			$this->request->data = $this->Puntuacione->find('first', $options);
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
        $this->request->data['Puntuacione']['id']     = $id;
	    $this->request->data['Puntuacione']['activo'] = 2;
	    $this->Puntuacione->save($this->request->data);
	}
}
