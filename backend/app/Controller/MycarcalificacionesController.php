<?php
App::uses('AppController', 'Controller');
/**
 * Mycarcalificaciones Controller
 *
 * @property Mycarcalificacione $Mycarcalificacione
 * @property PaginatorComponent $Paginator
 * @property FlashComponent $Flash
 * @property SessionComponent $Session
 */
class MycarcalificacionesController extends AppController {

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
		$this->checkSession(3);
	}

/**
 * index method
 *
 * @return void
 */
	public function index() {
     	  $usuario_rol      = $this->Session->read('usuario_rol');
     	  $usuario_id       = $this->Session->read('usuario_id');
          $this->set('mycarcalificaciones', $this->Mycarcalificacione->find('all', array('conditions'=>array('Mycarcalificacione.activo'=>1))));
     	
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
		if (!$this->Mycarcalificacione->exists($id)) {
			throw new NotFoundException(__('Invalid mycarcalificacione'));
		}
		$options = array('conditions' => array('Mycarcalificacione.' . $this->Mycarcalificacione->primaryKey => $id));
		$this->set('mycarcalificacione', $this->Mycarcalificacione->find('first', $options));
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
			$this->Mycarcalificacione->create();
			if ($this->Mycarcalificacione->save($this->request->data)) {
				$this->Flash->success(__('Registro Guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('Registro no Guardado. Por favor, inténtelo de nuevo.'));
			}
		}
		$mycars = $this->Mycarcalificacione->Mycar->find('list', array('conditions'=>array('Mycar.activo'=>1)));
		$usuarios = $this->Mycarcalificacione->Usuario->find('list');
		$this->set(compact('mycars', 'usuarios'));
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
		if (!$this->Mycarcalificacione->exists($id)) {
			throw new NotFoundException(__('Invalid mycarcalificacione'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Mycarcalificacione->save($this->request->data)) {
				$this->Flash->success(__('Registro Guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('Registro no Guardado. Por favor, inténtelo de nuevo.'));
			}
		} else {
			$options = array('conditions' => array('Mycarcalificacione.' . $this->Mycarcalificacione->primaryKey => $id));
			$this->request->data = $this->Mycarcalificacione->find('first', $options);
		}
		$mycars = $this->Mycarcalificacione->Mycar->find('list', array('conditions'=>array('Mycar.activo'=>1)));
		$usuarios = $this->Mycarcalificacione->Usuario->find('list');
		$this->set(compact('mycars', 'usuarios'));
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
        $this->request->data['Mycarcalificacione']['id']     = $id;
	    $this->request->data['Mycarcalificacione']['activo'] = 2;
	}
}
