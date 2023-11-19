<?php
App::uses('AppController', 'Controller');
/**
 * Mycarservicios Controller
 *
 * @property Mycarservicio $Mycarservicio
 * @property PaginatorComponent $Paginator
 * @property FlashComponent $Flash
 * @property SessionComponent $Session
 */
class MycarserviciosController extends AppController {

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
          $this->set('mycarservicios', $this->Mycarservicio->find('all', array('conditions'=>array('Mycarservicio.activo'=>1))));
     	
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
		if (!$this->Mycarservicio->exists($id)) {
			throw new NotFoundException(__('Invalid mycarservicio'));
		}
		$options = array('conditions' => array('Mycarservicio.' . $this->Mycarservicio->primaryKey => $id));
		$this->set('mycarservicio', $this->Mycarservicio->find('first', $options));
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
			$this->Mycarservicio->create();
			if ($this->Mycarservicio->save($this->request->data)) {
				$this->Flash->success(__('Registro Guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('Registro no Guardado. Por favor, inténtelo de nuevo.'));
			}
		}
		$mycars = $this->Mycarservicio->Mycar->find('list');
		$categorias = $this->Mycarservicio->Categorium->find('list');
		$categoriasubs = $this->Mycarservicio->Categoriasub->find('list');
		$this->set(compact('mycars', 'categorias', 'categoriasubs'));
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
		if (!$this->Mycarservicio->exists($id)) {
			throw new NotFoundException(__('Invalid mycarservicio'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Mycarservicio->save($this->request->data)) {
				$this->Flash->success(__('Registro Guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('Registro no Guardado. Por favor, inténtelo de nuevo.'));
			}
		} else {
			$options = array('conditions' => array('Mycarservicio.' . $this->Mycarservicio->primaryKey => $id));
			$this->request->data = $this->Mycarservicio->find('first', $options);
		}
		$mycars = $this->Mycarservicio->Mycar->find('list');
		$categorias = $this->Mycarservicio->Categorium->find('list');
		$categoriasubs = $this->Mycarservicio->Categoriasub->find('list');
		$this->set(compact('mycars', 'categorias', 'categoriasubs'));
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
        $this->request->data['Mycarservicio']['id']     = $id;
	    $this->request->data['Mycarservicio']['activo'] = 2;
	}
}
