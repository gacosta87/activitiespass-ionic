<?php
App::uses('AppController', 'Controller');
/**
 * Configuraciones Controller
 *
 * @property Configuracione $Configuracione
 * @property PaginatorComponent $Paginator
 * @property FlashComponent $Flash
 * @property SessionComponent $Session
 */
class ConfiguracionesController extends AppController {

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
          $this->set('configuraciones', $this->Configuracione->find('all', array('conditions'=>array('Configuracione.activo'=>1))));
     	
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
		if (!$this->Configuracione->exists($id)) {
			throw new NotFoundException(__('Invalid configuracione'));
		}
		$options = array('conditions' => array('Configuracione.' . $this->Configuracione->primaryKey => $id));
		$this->set('configuracione', $this->Configuracione->find('first', $options));
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
			$this->Configuracione->create();
			if ($this->Configuracione->save($this->request->data)) {
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
		if (!$this->Configuracione->exists($id)) {
			throw new NotFoundException(__('Invalid configuracione'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Configuracione->save($this->request->data)) {
				$this->Flash->success(__('Registro Guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('Registro no Guardado. Por favor, inténtelo de nuevo.'));
			}
		} else {
			$options = array('conditions' => array('Configuracione.' . $this->Configuracione->primaryKey => $id));
			$this->request->data = $this->Configuracione->find('first', $options);
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
        $this->request->data['Configuracione']['id']     = $id;
	    $this->request->data['Configuracione']['activo'] = 2;
	    $this->Configuracione->save($this->request->data);
	}
}
