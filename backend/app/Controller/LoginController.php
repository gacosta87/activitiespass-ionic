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

	public $components = array('Paginator', 'Session', 'Flash');

	public $uses = array('Usuario');


	public function index(){
		$this->layout = "login";

	}

	public function entrar(){
		$this->layout = 'login';
		$Usuario   = trim(strtoupper($this->request->data['Usuario']['user']));
	    $clave    = md5(trim(strtoupper($this->request->data['Usuario']['clave'])));
	    $c = $this->Usuario->find('count',array('conditions'=>array('Usuario.username'=>$Usuario,'clave'=>$clave, 'Usuario.verificado'=>2)));
	    if($c!=0){
	      $this->Usuario->recursive = 2;
	      $d = $this->Usuario->find('all',  array('conditions'=>array('Usuario.username'=>$Usuario,'clave'=>$clave, 'Usuario.verificado'=>2)));
		    extract($d[0]["Usuario"]);
		    $this->Session->write('usuario_id',  $id);
		    $this->Session->write('usuario_rol', $role_id);
	        $this->Session->write('inicio_session', true);
	        $this->Flash->success(__('Bienvenido al panel de administrador, ha iniciado sesion correctamente.'));
	        return $this->redirect(array('controller' => 'principal', 'action' => 'index'));
	    }else{
	      	$this->Flash->error(__('Lo siento, su usuario o clave son incorrectos.'));
	      	return $this->redirect(array('controller' => 'login', 'action' => 'index'));
	    }
	}

	public function logout($close = null) {
	    $this->layout = 'login';
	    $this->Session->delete('inicio_session');
	    if($close == 'close'){
	      $this->Flash->error(__('Debe iniciar sesion.'));
	    }else{
	      $this->Flash->success(__('Su sesion ha sido cerrada correctamente.'));
	      $this->Session->delete('usuario_id');
	    }
	  }

	  /**
	 * logout method
	 *
	 * @return void
	*/
	public function autentificar($id = null) {
		$this->layout = 'verificado';
		$d = $this->Usuario->find('all',  array('conditions'=>array('registroid'=>$id)));
		foreach ($d as $key){
			if($key['Usuario']['verificado']==1){
					$this->request->data['Usuario']['id']         = $key['Usuario']['id'];
					$this->request->data['Usuario']['verificado'] = 2;
					$this->Usuario->save($this->request->data);
					$this->Flash->success(__('El e-mail de esta cuenta ya se encuentra autentificado.'));
			}else{
					$this->Flash->error(__('El e-mail de esta cuenta ya ha sido autentificado anteriormente.'));
			}
		}//fin foreach
	}


}
?>