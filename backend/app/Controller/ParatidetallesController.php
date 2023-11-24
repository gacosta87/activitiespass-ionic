<?php
App::uses('AppController', 'Controller');
/**
 * Paratidetalles Controller
 *
 * @property Paratidetalle $Paratidetalle
 * @property PaginatorComponent $Paginator
 * @property FlashComponent $Flash
 * @property SessionComponent $Session
 */
class ParatidetallesController extends AppController {

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
		$this->checkSession(8);
	}

/**
 * index method
 *
 * @return void
 */
	public function index() {
     	  $usuario_rol      = $this->Session->read('usuario_rol');
     	  $usuario_id       = $this->Session->read('usuario_id');
          $this->set('paratidetalles', $this->Paratidetalle->find('all', array('conditions'=>array('Paratidetalle.activo'=>1))));
     	
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
		if (!$this->Paratidetalle->exists($id)) {
			throw new NotFoundException(__('Invalid paratidetalle'));
		}
		$options = array('conditions' => array('Paratidetalle.' . $this->Paratidetalle->primaryKey => $id));
		$this->set('paratidetalle', $this->Paratidetalle->find('first', $options));
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
			$this->Paratidetalle->create();

			$datos = $this->request->data['Paratidetalle']['url_foto'];
			if(!empty($datos)){
					$imageName = $datos['name']."_".time().'.png';
					$dir = basename("upload")."/".$imageName;
					move_uploaded_file($datos['tmp_name'], $dir);
					$this->request->data['Paratidetalle']['url_foto'] = $dir;
			}else{
				$this->request->data['Paratidetalle']['url_foto'] = "";
			}

			if ($this->Paratidetalle->save($this->request->data)) {
				$this->Flash->success(__('Registro Guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('Registro no Guardado. Por favor, inténtelo de nuevo.'));
			}
		}
		$paraticategorias = $this->Paratidetalle->Paraticategoria->find('list');
		$this->set(compact('paraticategorias'));
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
		if (!$this->Paratidetalle->exists($id)) {
			throw new NotFoundException(__('Invalid paratidetalle'));
		}
		if ($this->request->is(array('post', 'put'))) {

			$datos = $this->request->data['Paratidetalle']['url_foto'];
			if(!empty($datos) && $datos['name']!=""){
					$imageName = $datos['name']."_".time().'.png';
					$dir = basename("upload")."/".$imageName;
					move_uploaded_file($datos['tmp_name'], $dir);
					$this->request->data['Paratidetalle']['url_foto'] = $dir;
			}else{
				unset($this->request->data['Paratidetalle']['url_foto']);
			}

			if ($this->Paratidetalle->save($this->request->data)) {
				$this->Flash->success(__('Registro Guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('Registro no Guardado. Por favor, inténtelo de nuevo.'));
			}
		} else {
			$options = array('conditions' => array('Paratidetalle.' . $this->Paratidetalle->primaryKey => $id));
			$this->request->data = $this->Paratidetalle->find('first', $options);
		}
		$paraticategorias = $this->Paratidetalle->Paraticategoria->find('list');
		$this->set(compact('paraticategorias'));
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
        $this->request->data['Paratidetalle']['id']     = $id;
	    $this->request->data['Paratidetalle']['activo'] = 2;
	    $this->Paratidetalle->save($this->request->data);
	}
}
