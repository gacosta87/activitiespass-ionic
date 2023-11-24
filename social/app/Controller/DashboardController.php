<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('AppController', 'Controller');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class DashboardController extends AppController {

	public $components = array('Paginator', 'Session', 'Flash');

/**
 * This controller does not use a model
 *
 * @var array
 */
	public $uses = array('Empresa', 'User');

	public function beforeFilter() {
		$this->checkSession(0);
	}

	public $layout = "dashbord";

/*

Trabajadores

		1) proyectos trabajados
		2) proyectos activos
		4) tareas realizadas 
		5) tareas pendientes
		en function a eso sacar graficas por mes, de tareas

*/
	function index(){
		$this->layout = "dashbord";
		$this->set('empresas', $this->Empresa->find('all'));
		$a = $this->Session->read('MODULOS');
		$empresa_id          = $this->Session->read('empresa_id');
     	$empresasurcusale_id = $this->Session->read('empresasurcusale_id');
     	$rol_id              = $this->Session->read('ROL');
     	$user_id             = $this->Session->read('USUARIO_ID');
     	$cliente_id          = $this->Session->read('cliente_id');
     	$nominapersonale_id  = $this->Session->read('nominapersonale_id');
     	$moneda_id           = $this->Session->read('moneda_id');
		      if($rol_id==1){
				  
				 $this->render('dashboard1'); //Super root

	    }else if($rol_id==2){  

	            $this->render('dashboard2'); //root

	    }else if($rol_id==3){  
               
	            $this->render('dashboard3'); //administrador

	    }else if($rol_id==4){  
		        
			    $this->render('dashboard4'); //trabajador
				
	    }else if($rol_id==5){  
              
	            $this->render('dashboard5'); //cliente

		}else if($rol_id==6){  //Testing

			    $this->render('dashboard6'); //cliente

		}else{


		}

		
		//$this->Session->write('organomniveles', $this->Organomnivele->find('all', array('order'=>array('Organomnivele.id'=>'ASC'), 'conditions'=>array('Organomnivele.activo'=>1, 'Organomnivele.empresa_id'=>$empresa_id))));
		
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
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit_pass($id = null) {
		$this->layout = "dashbord";
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
		$roles = $this->User->Role->find('list');
		$empresa_id          = $this->Session->read('empresa_id');
	    $empresasurcusale_id = $this->Session->read('empresasurcusale_id');
              if($empresa_id==0 && $empresasurcusale_id==0){
               $roles           = $this->User->Role->find('list');
		       $empresas          = $this->User->Empresa->find('list'); 
		       $empresasurcusales = array();
        }else if($empresa_id!=0 && $empresasurcusale_id==0){
        	   $roles           = $this->User->Role->find('list', array('conditions'=>array('Role.id !='=>array(1,2))));
		       $empresas          = $this->User->Empresa->find('list', array('conditions'=>array('id'=>$empresa_id)));
		       $empresasurcusales = $this->User->Empresasurcusale->find('list', array('conditions'=>array('empresa_id'=>$empresa_id)));
        }else if($empresa_id!=0 && $empresasurcusale_id!=0){
        	   $roles           = $this->User->Role->find('list', array('conditions'=>array('Role.id !='=>array(1,2,3))));
		       $empresas          = $this->User->Empresa->find('list', array('conditions'=>array('id'=>$empresa_id)));
		       $empresasurcusales = $this->User->Empresasurcusale->find('list', array('conditions'=>array('empresa_id'=>$empresa_id, 'id'=>$empresasurcusale_id)));
        }
		$this->set(compact('roles', 'empresas', 'empresasurcusales', 'estatus'));
	}
}
?>