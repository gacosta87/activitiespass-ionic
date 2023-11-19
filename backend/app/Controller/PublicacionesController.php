<?php
App::uses('AppController', 'Controller');
/**
 * Publicaciones Controller
 *
 * @property Publicacione $Publicacione
 * @property PaginatorComponent $Paginator
 * @property FlashComponent $Flash
 * @property SessionComponent $Session
 */
class PublicacionesController extends AppController {

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
          $this->set('publicaciones', $this->Publicacione->find('all', array('conditions'=>array('Publicacione.tipo'=>3, 'Publicacione.activo'=>1))));
     	
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
		if (!$this->Publicacione->exists($id)) {
			throw new NotFoundException(__('Invalid publicidade'));
		}
		$options = array('conditions' => array('Publicacione.' . $this->Publicacione->primaryKey => $id));
		$this->set('publicidade', $this->Publicacione->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
	    $usuario_rol      = $this->Session->read('usuario_rol');
     	$usuario_id       = $this->Session->read('usuario_id');
     	$this->request->data['Publicacione']['valido'] = 2;
		if ($this->request->is('post')) {
			$this->Publicacione->create();
			$datos = $this->request->data['Publicacione']['imagen1'];
			if(!empty($datos) && $datos['name']!=""){
					$imageName = $datos['name']."_".time().'.png';
					$dir = basename("upload")."/".$imageName;
					move_uploaded_file($datos['tmp_name'], $dir);
					$this->request->data['Publicacione']['imagen1'] = Configure::read('url_sitio').$dir;
			}else{
				unset($this->request->data['Publicacione']['imagen1']);
			}
			if ($this->Publicacione->save($this->request->data)) {
				$this->Flash->success(__('Registro Guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('Registro no Guardado. Por favor, inténtelo de nuevo.'));
			}
		}
		$paraticategorias = $this->Publicacione->Paraticategoria->find('list');
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
		if (!$this->Publicacione->exists($id)) {
			throw new NotFoundException(__('Invalid publicidade'));
		}
		if ($this->request->is(array('post', 'put'))) {
			$datos = $this->request->data['Publicacione']['imagen'];
			if(!empty($datos) && $datos['name']!=""){
					$imageName = $datos['name']."_".time().'.png';
					$dir = basename("upload")."/".$imageName;
					move_uploaded_file($datos['tmp_name'], $dir);
					$this->request->data['Publicacione']['imagen'] = $dir;
			}else{
				unset($this->request->data['Publicacione']['imagen']);
			}
			if ($this->Publicacione->save($this->request->data)) {
				$this->Flash->success(__('Registro Guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('Registro no Guardado. Por favor, inténtelo de nuevo.'));
			}
		} else {
			$options = array('conditions' => array('Publicacione.' . $this->Publicacione->primaryKey => $id));
			$this->request->data = $this->Publicacione->find('first', $options);
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
        $this->request->data['Publicacione']['id']     = $id;
	    $this->request->data['Publicacione']['activo'] = 2;
	    $this->Publicacione->save($this->request->data);
	}
}
