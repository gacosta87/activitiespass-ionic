<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class UsersController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session','Flash');

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
		$this->checkSession(2);
	}

/**
 * index method
 *
 * @return void
 */
	public function index() {
		//$this->User->recursive = 0;
		//$this->set('users', $this->Paginator->paginate());
		
		//$this->set('users', $this->User->find('all'));

		$empresa_id          = $this->Session->read('empresa_id');
	    $empresasurcusale_id = $this->Session->read('empresasurcusale_id');

              if($empresa_id==0 && $empresasurcusale_id==0){
              	 $this->set('users', $this->User->find('all', array('conditions'=>array('User.id !='=>1))));
        }else if($empresa_id!=0 && $empresasurcusale_id==0){
        	     $this->set('users', $this->User->find('all', array('conditions'=>array('User.id !='=>1, 'User.empresa_id'=>$empresa_id))));
        }else if($empresa_id!=0 && $empresasurcusale_id!=0){
        	     $this->set('users', $this->User->find('all', array('conditions'=>array('User.id !='=>1, 'User.empresa_id'=>$empresa_id, 'User.empresasurcusale_id'=>$empresasurcusale_id))));
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
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$this->set('user', $this->User->find('first', $options));
	}




/**
 * add method
 *
 * @return void
 */
	public function upload() {
		$this->layout="ajax";
		$this->Session->write('foto',$this->request->data['image']);
	}



/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->User->create();
			$this->request->data['User']['password'] = md5(trim(strtoupper($this->request->data['User']['password'])));
			
            //$this->request->data['User']['empresa_id'] = 1;
            //$this->request->data['User']['empresasurcusale_id'] = 1;
			//SUBIR FOTO
			$datos = $this->Session->read('foto');
			list($type, $datos) = explode(';', $datos);
			list(, $datos)      = explode(',', $datos);
			$datos = base64_decode($datos);
			$imageName = time().'.png';
			$dir = basename("upload")."/".$imageName;
			file_put_contents($dir, $datos);
			$this->request->data['User']['foto'] = $dir;
			if ($this->User->save($this->request->data)) {
				$this->Flash->success(__('Registro Guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('Registro no Guardado. Por favor, inténtelo de nuevo.'));
			}
		}
		$estatus = $this->User->Estatus->find('list');
		$roles   = $this->User->Role->find('list');
		$empresa_id          = $this->Session->read('empresa_id');
	    $empresasurcusale_id = $this->Session->read('empresasurcusale_id');
              if($empresa_id==0 && $empresasurcusale_id==0){
               $roles             = $this->User->Role->find('list', array('conditions'=>array('Role.id'=>array(2))));
		       $empresas          = $this->User->Empresa->find('list'); 
		       $empresasurcusales = array(0=>'N/A');
        }else if($empresa_id!=0 && $empresasurcusale_id==0){
        	   $roles             = $this->User->Role->find('list', array('conditions'=>array('Role.id'=>array(3))));
		       $empresas          = $this->User->Empresa->find('list', array('conditions'=>array('id'=>$empresa_id)));
		       $empresasurcusales = $this->User->Empresasurcusale->find('list', array('conditions'=>array('empresa_id'=>$empresa_id)));
        }else if($empresa_id!=0 && $empresasurcusale_id!=0){
        	   $roles             = $this->User->Role->find('list', array('conditions'=>array('Role.id !='=>array(1,2,3))));
		       $empresas          = $this->User->Empresa->find('list', array('conditions'=>array('id'=>$empresa_id)));
		       $empresasurcusales = $this->User->Empresasurcusale->find('list', array('conditions'=>array('empresa_id'=>$empresa_id, 'id'=>$empresasurcusale_id)));
        }
		$this->set(compact('roles', 'estatus', 'empresas', 'empresasurcusales'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if($this->request->data["User"]["password2"]!=$this->request->data["User"]["password"]){
				$this->request->data['User']['password'] = md5(trim(strtoupper($this->request->data['User']['password'])));
			}else{
				unset($this->request->data['User']['password']);
			}
			if(!isset($this->request->data['User']['respaldo'])){
				//SUBIR FOTO
				$datos = $this->Session->read('foto');
				list($type, $datos) = explode(';', $datos);
				list(, $datos)      = explode(',', $datos);
				$datos = base64_decode($datos);
				$imageName = time().'.png';
				$dir = basename("upload")."/".$imageName;
				file_put_contents($dir, $datos);
				$this->request->data['User']['foto'] = $dir;
				$this->Session->write('foto', $dir);
			}
			if ($this->User->save($this->request->data)) {
				$this->Flash->success(__('Registro Guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('Registro no Guardado. Por favor, inténtelo de nuevo.'));
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
		}
		$estatus = $this->User->Estatus->find('list');
		$roles   = $this->User->Role->find('list');
		$empresa_id          = $this->Session->read('empresa_id');
	    $empresasurcusale_id = $this->Session->read('empresasurcusale_id');
             if($empresa_id==0 && $empresasurcusale_id==0){
               $roles             = $this->User->Role->find('list', array('conditions'=>array('Role.id'=>array(2))));
		       $empresas          = $this->User->Empresa->find('list'); 
		       $empresasurcusales = array(0=>'N/A');
        }else if($empresa_id!=0 && $empresasurcusale_id==0){
        	   $roles             = $this->User->Role->find('list', array('conditions'=>array('Role.id'=>array(3))));
		       $empresas          = $this->User->Empresa->find('list', array('conditions'=>array('id'=>$empresa_id)));
		       $empresasurcusales = $this->User->Empresasurcusale->find('list', array('conditions'=>array('empresa_id'=>$empresa_id)));
        }else if($empresa_id!=0 && $empresasurcusale_id!=0){
        	   $roles             = $this->User->Role->find('list', array('conditions'=>array('Role.id !='=>array(1,2,3))));
		       $empresas          = $this->User->Empresa->find('list', array('conditions'=>array('id'=>$empresa_id)));
		       $empresasurcusales = $this->User->Empresasurcusale->find('list', array('conditions'=>array('empresa_id'=>$empresa_id, 'id'=>$empresasurcusale_id)));
        }
		$this->set(compact('roles', 'empresas', 'empresasurcusales', 'estatus'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			//throw new NotFoundException(__('Invalid user'));
		}
		//$this->request->allowMethod('post', 'delete');
		if ($this->User->delete()) {
			$this->Flash->success(__('El Registro fue eliminado.'));
		} else {
			$this->Flash->error(__('El Registro no fue eliminado. Por favor, inténtelo de nuevo.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
