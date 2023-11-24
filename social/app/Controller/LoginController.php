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
class LoginController extends AppController {

/**
 * This controller does not use a model
 *
 * @var array
 */
	public $uses = array('User', 'Empresa', 'Organomnivele');

	public $components = array('Paginator', 'Flash', 'Session');

	function index(){
		$this->layout = "login";
		$this->set('empresas', $this->Empresa->find('all'));
	}


	function ValidateLogin(){
		$this->layout = 'login';
		$user     = trim(strtoupper($this->request->data['Admin']['user']));
	    $password = md5(trim(strtoupper($this->request->data['Admin']['password'])));
	    $c = $this->User->find('count',array('conditions'=>array('username'=>$user,'password'=>$password, 'User.estatu_id'=>1)));
	    if($c!=0){
	      $this->User->recursive = 2;
	      $d = $this->User->find('all',  array('conditions'=>array('username'=>$user,'password'=>$password, 'User.estatu_id'=>1)));
	      //pr($d);
		    $this->Session->write('USUARIO_MODULOS', $d[0]['Usermodulo']);
		    extract($d[0]["User"]);
	        $this->Session->write('USUARIO_STATUS', $estatu_id);
		    $this->Session->write('USUARIO_ID',    $id);
		    $this->Session->write('ROL', $role_id);
		    $this->Session->write('MODULOS', $d[0]["Role"]["Rolesmodulo"]);
	        $this->Session->write('usuario_valido', true);
	        $this->Session->write('username', $username);
	        $this->Session->write('usuario', $nombre_apellido);
			$this->Session->write('foto', $foto);
	        $this->Session->write('cliente_id', $cliente_id);
	        $this->Session->write('nominapersonale_id', $nominapersonale_id);
	        $this->Session->write('roldeno', $d[0]["Role"]["title"]);
	        $this->Session->write('moneda_id',    $d[0]["Empresa"]['moneda_id']);
	        $this->Session->write('moneda_signo', isset($d[0]["Empresa"]['Moneda']['signo'])?$d[0]["Empresa"]['Moneda']['signo']:0);
	        $this->Session->write('empresa_id', $empresa_id);
	        $this->Session->write('empresasurcusale_id', $empresasurcusale_id);
	        $this->Session->write('empresa_name',          $d[0]['Empresa']['razon_social']);
	        $this->Session->write('empresasurcusale_name', $d[0]['Empresasurcusale']['denominacion']);
	        //$this->Session->write('organomniveles', $this->Organomnivele->find('all', array('order'=>array('Organomnivele.id'=>'ASC'), 'conditions'=>array('Organomnivele.activo'=>1, 'Organomnivele.empresa_id'=>$empresa_id))));
	        $this->Flash->success(__('Bienvenido al panel de administrador, ha iniciado sesion correctamente.'));
	        return $this->redirect(array('controller' => 'dashboard', 'action' => 'index'));
	    }else{
	      	$this->Flash->error(__('Lo siento, su usuario o password son incorrectos.'));
	      	return $this->redirect(array('controller' => 'login', 'action' => 'index'));
	    }
	}



	/**
	 * logout method
	 *
	 * @return void
	 */
	  public function logout($close = null) {
	    $this->layout = 'login';
	    $this->Session->delete('usuario_valido');
	    if($close == 'close'){
	      $this->Flash->error(__('Debe iniciar sesion.'));
	    }else{
	      $this->Flash->success(__('Su sesion ha sido cerrada correctamente.'));
	      $this->Session->delete('USUARIO_ID');
		  $this->Session->delete('USUARIO_NIVEL');
		  $this->Session->delete('username');
	    }
	   // return $this->redirect(array('controller' => 'login', 'action' => 'index'));
	  }



	
}
?>