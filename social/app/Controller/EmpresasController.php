<?php
App::uses('AppController', 'Controller');
/**
 * Empresas Controller
 *
 * @property Empresa $Empresa
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class EmpresasController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session', 'Flash');


	var $uses = array('Empresa');

/*
** var de layout
*
*/
	public $layout = "dashbord";

/*
*  *  beforeFilter check de session
*
*/	
	public function beforeFilter() {
		$this->checkSession(4);
	}

/**
 * index method
 *
 * @return void
 */
	public function index() {
		//$this->Empresa->recursive = 0;
		//$this->set('empresas', $this->Paginator->paginate());
		  $this->set('empresas', $this->Empresa->find('all'));

		  $empresa_id          = $this->Session->read('empresa_id');
     	  $empresasurcusale_id = $this->Session->read('empresasurcusale_id');
     	  $rol_id              = $this->Session->read('ROL');
     	  $user_id             = $this->Session->read('USUARIO_ID');
     	      if($empresa_id==0 && $empresasurcusale_id==0){ 
     		  	$this->set('empresas', $this->Empresa->find('all'));
     	}else if($empresa_id!=0 && $empresasurcusale_id==0){
     		$this->set('empresas', $this->Empresa->find('all', array('conditions'=>array('Empresa.id'=>$empresa_id))));
      	}else if($empresa_id!=0 && $empresasurcusale_id!=0 && $rol_id==3){
      		$this->set('empresas', $this->Empresa->find('all', array('conditions'=>array('Empresa.id'=>$empresa_id))));
      	}else{
      		$this->set('empresas', $this->Empresa->find('all', array('conditions'=>array('Empresa.id'=>$empresa_id))));
      	}
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Empresa->exists($id)) {
			throw new NotFoundException(__('Invalid empresa'));
		}
		$options = array('conditions' => array('Empresa.' . $this->Empresa->primaryKey => $id));
		$this->set('empresa', $this->Empresa->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		  $empresa_id          = $this->Session->read('empresa_id');
     	  $empresasurcusale_id = $this->Session->read('empresasurcusale_id');
     	  $rol_id              = $this->Session->read('ROL');
     	  $user_id             = $this->Session->read('USUARIO_ID');
		if ($this->request->is('post')) {
			$this->Empresa->create();
			if ($this->Empresa->save($this->request->data)) {

				$empresa_id2 =  $this->Empresa->id;
				
                $this->request->data['Actuacioncompetenciatipo']['empresa_id']   = $empresa_id2;
                $this->request->data['Actuacioncompetenciatipo']['codigo']       = '1';
                $this->request->data['Actuacioncompetenciatipo']['denominacion'] = 'FUNCIONALES';
                $this->Actuacioncompetenciatipo->create();
                $this->Actuacioncompetenciatipo->save($this->request->data);

                $this->request->data['Actuacioncompetenciatipo']['empresa_id']   = $empresa_id2;
                $this->request->data['Actuacioncompetenciatipo']['codigo']       = '2';
                $this->request->data['Actuacioncompetenciatipo']['denominacion'] = 'CONDUCTUALES';
                $this->Actuacioncompetenciatipo->create();
                $this->Actuacioncompetenciatipo->save($this->request->data);

                $this->request->data['Actuacioncompetenciatipo']['empresa_id']   = $empresa_id2;
                $this->request->data['Actuacioncompetenciatipo']['codigo']       = '3';
                $this->request->data['Actuacioncompetenciatipo']['denominacion'] = 'OBJETIVOS';
                $this->Actuacioncompetenciatipo->create();
                $this->Actuacioncompetenciatipo->save($this->request->data);

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
		if (!$this->Empresa->exists($id)) {
			throw new NotFoundException(__('Invalid empresa'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Empresa->save($this->request->data)) {
				$this->Flash->success(__('Registro Guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('Registro no Guardado. Por favor, inténtelo de nuevo.'));
			}
		} else {
			$options = array('conditions' => array('Empresa.' . $this->Empresa->primaryKey => $id));
			$this->request->data = $this->Empresa->find('first', $options);
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
		$this->Empresa->id = $id;
		if (!$this->Empresa->exists()) {
			throw new NotFoundException(__('Invalid empresa'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Empresa->delete()) {
			$this->Flash->success(__('El Registro fue eliminado.'));
		} else {
			$this->Flash->error(__('El Registro no fue eliminado. Por favor, inténtelo de nuevo.'));
		}
		return $this->redirect(array('action' => 'index'));
	}


	/**
 * index method
 *
 * @return void
 */
	public function provincia($id) {
		$this->layout="ajax";
		$direprovincias = $this->Empresa->Direprovincia->find('list', array('conditions'=>array('direpai_id'=>$id)));
	    $this->set('direprovincias', $direprovincias);
	    $this->set('id', $id);
	}
}
