<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
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

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {


	var $uses = array();

	function checkSession($mod=null){
	    if($this->Session->check('usuario_valido')==false){
	       $this->redirect('/login/logout/close');
	       return false;
	    }else{
          
		   $empresa_id = $this->Session->read('empresa_id'); 
		   $empresasurcusale_id = $this->Session->read('empresasurcusale_id');
     	   $rol_id              = $this->Session->read('ROL');
     	   $user_id             = $this->Session->read('USUARIO_ID');
     	   $nominapersonale_id  = $this->Session->read('nominapersonale_id');
           $modulos    = $this->Session->read('MODULOS');
           $empresa_id = $this->Session->read('empresa_id'); 
           $activa[0] = 1;
	       for($i=1; $i<=20; $i++){
	        $activa[$i] = 0;
	       }
	       foreach ($modulos as $modulo) {
	           $activa[$modulo['modulo_id']] = 1;

	       }
	       if(isset($activa[$mod])){
	           if($activa[$mod]==1){
	           	 $_SESSION["MODULO_ACTIVO"]=$mod;
	           	 return true;
	           	}else{
	              $this->Flash->success(__('No tiene permisos para la modulo indicado.'));
		          return $this->redirect(array('controller' => 'dashboard', 'action' => 'index'));
		          return true;
	           	}
           }else{
           	      $this->Flash->success(__('No tiene permisos para la modulo indicado..'));
		          return $this->redirect(array('controller' => 'dashboard', 'action' => 'index'));
		          return true;
           }
	    }	
	}
}
