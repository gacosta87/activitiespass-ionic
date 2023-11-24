<?php
/**
 * Bake Template for Controller action generation.
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
 * @package       Cake.Console.Templates.default.actions
 * @since         CakePHP(tm) v 1.3
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
?>
/*
*<?php echo $admin ?>
* var de layout
*
*/
	public $layout = "dashbord";

/*
*  <?php echo $admin ?>
*  beforeFilter check de session
*
*/	
	public function beforeFilter() {
		$this->checkSession();
	}

/**
 * <?php echo $admin ?>index method
 *
 * @return void
 */
	public function <?php echo $admin ?>index() {
		//$this-><?php echo $currentModelName ?>->recursive = 0;
		//$this->set('<?php echo $pluralName ?>', $this->Paginator->paginate());
		  $empresa_id          = $this->Session->read('empresa_id');
     	  $empresasurcusale_id = $this->Session->read('empresasurcusale_id');
     	  $rol_id              = $this->Session->read('ROL');
     	  $user_id             = $this->Session->read('USUARIO_ID');
     	      if($empresa_id==0 && $empresasurcusale_id==0){ 
     		  	$this->set('<?php echo $pluralName ?>', $this-><?php echo $currentModelName ?>->find('all', array('conditions'=>array('<?php echo $currentModelName ?>.activo'=>1))));
     	}else if($empresa_id!=0 && $empresasurcusale_id==0){
     		$this->set('<?php echo $pluralName ?>', $this-><?php echo $currentModelName ?>->find('all', array('conditions'=>array('<?php echo $currentModelName ?>.activo'=>1, '<?php echo $currentModelName ?>.empresa_id'=>$empresa_id))));
      	}else if($empresa_id!=0 && $empresasurcusale_id!=0 && $rol_id==3){
      		$this->set('<?php echo $pluralName ?>', $this-><?php echo $currentModelName ?>->find('all', array('conditions'=>array('<?php echo $currentModelName ?>.activo'=>1, '<?php echo $currentModelName ?>.empresa_id'=>$empresa_id, '<?php echo $currentModelName ?>.empresasurcusale_id'=>$empresasurcusale_id))));
      	}else{
      		//$this->set('<?php echo $pluralName ?>', $this-><?php echo $currentModelName ?>->find('all', array('conditions'=>array('<?php echo $currentModelName ?>.activo'=>1, '<?php echo $currentModelName ?>.empresa_id'=>$empresa_id, '<?php echo $currentModelName ?>.empresasurcusale_id'=>$empresasurcusale_id, 'Almacene.user_id'=>$user_id))));
      		$this->set('<?php echo $pluralName ?>', $this-><?php echo $currentModelName ?>->find('all', array('conditions'=>array('<?php echo $currentModelName ?>.activo'=>1, '<?php echo $currentModelName ?>.empresa_id'=>$empresa_id, '<?php echo $currentModelName ?>.empresasurcusale_id'=>$empresasurcusale_id))));
      	}
		  //$this->set('<?php echo $pluralName ?>', $this-><?php echo $currentModelName ?>->find('all'));
	}

/**
 * <?php echo $admin ?>view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function <?php echo $admin ?>view($id = null) {
	    $empresa_id          = $this->Session->read('empresa_id');
     	$empresasurcusale_id = $this->Session->read('empresasurcusale_id');
     	$rol_id              = $this->Session->read('ROL');
     	$user_id             = $this->Session->read('USUARIO_ID');
		if (!$this-><?php echo $currentModelName; ?>->exists($id)) {
			throw new NotFoundException(__('Invalid <?php echo strtolower($singularHumanName); ?>'));
		}
		$options = array('conditions' => array('<?php echo $currentModelName; ?>.' . $this-><?php echo $currentModelName; ?>->primaryKey => $id));
		$this->set('<?php echo $singularName; ?>', $this-><?php echo $currentModelName; ?>->find('first', $options));
	}

<?php $compact = array(); ?>
/**
 * <?php echo $admin ?>add method
 *
 * @return void
 */
	public function <?php echo $admin ?>add() {
	    $empresa_id          = $this->Session->read('empresa_id');
     	$empresasurcusale_id = $this->Session->read('empresasurcusale_id');
     	$rol_id              = $this->Session->read('ROL');
     	$user_id             = $this->Session->read('USUARIO_ID');
		if ($this->request->is('post')) {
			$this-><?php echo $currentModelName; ?>->create();
			if ($this-><?php echo $currentModelName; ?>->save($this->request->data)) {
<?php if ($wannaUseSession): ?>
				$this->Flash->success(__('Registro Guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('Registro no Guardado. Por favor, inténtelo de nuevo.'));
<?php else: ?>
				return $this->flash(__('Registro Guardado.'), array('action' => 'index'));
<?php endif; ?>
			}
		}
<?php
	foreach (array('belongsTo', 'hasAndBelongsToMany') as $assoc):
		foreach ($modelObj->{$assoc} as $associationName => $relation):
			if (!empty($associationName)):
				$otherModelName = $this->_modelName($associationName);
				$otherPluralName = $this->_pluralName($associationName);
				echo "\t\t\${$otherPluralName} = \$this->{$currentModelName}->{$otherModelName}->find('list');\n";
				$compact[] = "'{$otherPluralName}'";
			endif;
		endforeach;
	endforeach;
	if (!empty($compact)):
		echo "\t\t\$this->set(compact(".join(', ', $compact)."));\n";
	endif;
?>
	}

<?php $compact = array(); ?>
/**
 * <?php echo $admin ?>edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function <?php echo $admin; ?>edit($id = null) {
	    $empresa_id          = $this->Session->read('empresa_id');
     	$empresasurcusale_id = $this->Session->read('empresasurcusale_id');
     	$rol_id              = $this->Session->read('ROL');
     	$user_id             = $this->Session->read('USUARIO_ID');
		if (!$this-><?php echo $currentModelName; ?>->exists($id)) {
			throw new NotFoundException(__('Invalid <?php echo strtolower($singularHumanName); ?>'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this-><?php echo $currentModelName; ?>->save($this->request->data)) {
<?php if ($wannaUseSession): ?>
				$this->Flash->success(__('Registro Guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('Registro no Guardado. Por favor, inténtelo de nuevo.'));
<?php else: ?>
				return $this->flash(__('Registro Guardado.'), array('action' => 'index'));
<?php endif; ?>
			}
		} else {
			$options = array('conditions' => array('<?php echo $currentModelName; ?>.' . $this-><?php echo $currentModelName; ?>->primaryKey => $id));
			$this->request->data = $this-><?php echo $currentModelName; ?>->find('first', $options);
		}
<?php
		foreach (array('belongsTo', 'hasAndBelongsToMany') as $assoc):
			foreach ($modelObj->{$assoc} as $associationName => $relation):
				if (!empty($associationName)):
					$otherModelName = $this->_modelName($associationName);
					$otherPluralName = $this->_pluralName($associationName);
					echo "\t\t\${$otherPluralName} = \$this->{$currentModelName}->{$otherModelName}->find('list');\n";
					$compact[] = "'{$otherPluralName}'";
				endif;
			endforeach;
		endforeach;
		if (!empty($compact)):
			echo "\t\t\$this->set(compact(".join(', ', $compact)."));\n";
		endif;
	?>
	}

/**
 * <?php echo $admin ?>delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void 
 */
	public function <?php echo $admin; ?>delete($id = null) {
	    $empresa_id          = $this->Session->read('empresa_id');
     	$empresasurcusale_id = $this->Session->read('empresasurcusale_id');
     	$rol_id              = $this->Session->read('ROL');
     	$user_id             = $this->Session->read('USUARIO_ID');
		/*
			$this-><?php echo $currentModelName; ?>->id = $id;
			if (!$this-><?php echo $currentModelName; ?>->exists()) {
				throw new NotFoundException(__('Invalid <?php echo strtolower($singularHumanName); ?>'));
			}
			$this->request->allowMethod('post', 'delete');
			if ($this-><?php echo $currentModelName; ?>->delete()) {
			<?php if ($wannaUseSession): ?>
						$this->Flash->success(__('El Registro fue eliminado.'));
					} else {
						$this->Flash->error(__('El Registro no fue eliminado. Por favor, inténtelo de nuevo.'));
					}
					return $this->redirect(array('action' => 'index'));
			<?php else: ?>
						return $this->flash(__('El Registro fue eliminado.'), array('action' => 'index'));
					} else {
						return $this->error(__('El Registro no fue eliminado. Por favor, inténtelo de nuevo.'), array('action' => 'index'));
					}
			<?php endif; ?>
        */
        $this->request->data['<?php echo $currentModelName; ?>']['id']     = $id;
	    $this->request->data['<?php echo $currentModelName; ?>']['activo'] = 2;
		if ($this-><?php echo $currentModelName; ?>->save($this->request->data)) {
			$this->Flash->success(__('El Registro fue eliminado.'));
		} else {
			$this->Flash->error(__('El Registro no fue eliminado. Por favor, inténtelo de nuevo.'));
		}
		$this->layout = "ajax";
		//return $this->redirect(array('action' => 'index'));
	}
