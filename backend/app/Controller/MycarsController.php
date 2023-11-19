<?php
App::uses('AppController', 'Controller');
/**
 * Mycars Controller
 *
 * @property Mycar $Mycar
 * @property PaginatorComponent $Paginator
 * @property FlashComponent $Flash
 * @property SessionComponent $Session
 */
class MycarsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Flash', 'Session');

	var $uses = array('Mycar', 'Usuario', 'Categoria', 'Categoriasub', 'Mycarservicio', 'Role', 'Mycartag');

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
		$this->checkSession(3);
	}

/**
 * index method
 *
 * @return void
 */
	public function index() {
     	  $usuario_rol      = $this->Session->read('usuario_rol');
     	  $usuario_id       = $this->Session->read('usuario_id');
          $this->set('mycars', $this->Mycar->find('all', array('conditions'=>array('Mycar.activo'=>1))));
     	
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
		if (!$this->Mycar->exists($id)) {
			throw new NotFoundException(__('Invalid mycar'));
		}
		$options = array('conditions' => array('Mycar.' . $this->Mycar->primaryKey => $id));
		$this->set('mycar', $this->Mycar->find('first', $options));
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
			$this->Mycar->create();


			$datos = $this->request->data['Mycar']['foto1'];
			if(!empty($datos) && $datos['name']!=""){
					$imageName = $datos['name']."_".time().'.png';
					$dir = basename("upload")."/".$imageName;
					move_uploaded_file($datos['tmp_name'], $dir);
					$this->request->data['Mycar']['foto1'] = $dir;
			}else{
				$this->request->data['Mycar']['foto1'] = basename("upload")."/6-imagen2-03-03.png_1553457424.png";
			}
			$datos = $this->request->data['Mycar']['foto2'];
			if(!empty($datos) && $datos['name']!=""){
					$imageName = $datos['name']."_".time().'.png';
					$dir = basename("upload")."/".$imageName;
					move_uploaded_file($datos['tmp_name'], $dir);
					$this->request->data['Mycar']['foto2'] = $dir;
			}else{
				$this->request->data['Mycar']['foto2'] = basename("upload")."/6-imagen2-03-03.png_1553457424.png";
			}
			$datos = $this->request->data['Mycar']['foto3'];
			if(!empty($datos) && $datos['name']!=""){
					$imageName = $datos['name']."_".time().'.png';
					$dir = basename("upload")."/".$imageName;
					move_uploaded_file($datos['tmp_name'], $dir);
					$this->request->data['Mycar']['foto3'] = $dir;
			}else{
				$this->request->data['Mycar']['foto3'] = basename("upload")."/6-imagen2-03-03.png_1553457424.png";
			}

			$datos = $this->request->data['Mycar']['foto4'];
			if(!empty($datos) && $datos['name']!=""){
					$imageName = $datos['name']."_".time().'.png';
					$dir = basename("upload")."/".$imageName;
					move_uploaded_file($datos['tmp_name'], $dir);
					$this->request->data['Mycar']['foto4'] = $dir;
			}else{
				$this->request->data['Mycar']['foto4'] = basename("upload")."/6-imagen2-03-03.png_1553457424.png";
			}


			if ($this->Mycar->save($this->request->data)) {
				$id_mycars   =  $this->Mycar->id;
				$stop = 0;
				if(!empty($this->request->data["Afiliado"]["Modulos"])){
					foreach($this->request->data["Afiliado"]["Modulos"] as $modulo){
						$this->request->data["Mycarservicio"]["mycar_id"]        = $id_mycars;
						$this->request->data["Mycarservicio"]["categoria_id"]    = $modulo['tipo'];
						$this->request->data["Mycarservicio"]["categoriasub_id"] = $modulo['servicio'];
						$this->Mycarservicio->create();
						if ($this->Mycarservicio->save($this->request->data)) {

						}else{
							$stop = 1;
						}
					}
				}

				if(!empty($this->request->data["Afiliado"]["Modulos2"])){
					foreach($this->request->data["Afiliado"]["Modulos2"] as $modulo){
						$this->request->data["Mycartag"]["mycar_id"]     = $id_mycars;
						$this->request->data["Mycartag"]["denominacion"] = $modulo['denominacion'];
						$this->Mycartag->create();
						if ($this->Mycartag->save($this->request->data)) {

						}else{
							$stop = 1;
						}
					}
				}
				$this->request->data['Usuario']['mycar_id']        = $id_mycars;
                $this->request->data['Usuario']['role_id']         = $this->request->data['Usuario']['role_id'];
                $this->request->data['Usuario']['verificado']      = 2;
                $this->request->data['Usuario']['nombre_apellido'] = $this->request->data['Usuario']['representante']; 
                $this->request->data['Usuario']['nombres']         = $this->request->data['Usuario']['representante']; 
                $this->request->data['Usuario']['apellidos']       = $this->request->data['Usuario']['representante']; 
                $this->request->data['Usuario']['clave']           = md5(trim(strtoupper($this->request->data['Usuario']['clave'])));
			    $this->request->data['Usuario']['username']        = $this->request->data['Usuario']['email']; 
			    $this->request->data['Usuario']['email']           = $this->request->data['Usuario']['email']; 
				$this->Usuario->save($this->request->data);
				$this->Flash->success(__('Registro Guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('Registro no Guardado. Por favor, inténtelo de nuevo.'));
			}
		}
		$categorias = $this->Categoria->find('all', array('conditions'=>array('Categoria.activo'=>1)));
		$roles = $this->Role->find('list');
		$mycartipos = $this->Mycar->Mycartipo->find('list', array('conditions'=>array('Mycartipo.activo'=>1)));
		$this->set(compact('mycartipos', 'categorias', 'roles'));
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
		if (!$this->Mycar->exists($id)) {
			throw new NotFoundException(__('Invalid mycar'));
		}
		if ($this->request->is(array('post', 'put'))) {

			$datos = $this->request->data['Mycar']['foto1'];
			if(!empty($datos) && $datos['name']!=""){
					$imageName = $datos['name']."_".time().'.png';
					$dir = basename("upload")."/".$imageName;
					move_uploaded_file($datos['tmp_name'], $dir);
					$this->request->data['Mycar']['foto1'] = $dir;
			}else{
				unset($this->request->data['Mycar']['foto1']);
			}
			$datos = $this->request->data['Mycar']['foto2'];
			if(!empty($datos)  && $datos['name']!=""){
					$imageName = $datos['name']."_".time().'.png';
					$dir = basename("upload")."/".$imageName;
					move_uploaded_file($datos['tmp_name'], $dir);
					$this->request->data['Mycar']['foto2'] = $dir;
			}else{
				unset($this->request->data['Mycar']['foto2']);
			}
			$datos = $this->request->data['Mycar']['foto3'];
			if(!empty($datos)  && $datos['name']!=""){
					$imageName = $datos['name']."_".time().'.png';
					$dir = basename("upload")."/".$imageName;
					move_uploaded_file($datos['tmp_name'], $dir);
					$this->request->data['Mycar']['foto3'] = $dir;
			}else{
				unset($this->request->data['Mycar']['foto3']);
			}
			$datos = $this->request->data['Mycar']['foto4'];
			if(!empty($datos)  && $datos['name']!=""){
					$imageName = $datos['name']."_".time().'.png';
					$dir = basename("upload")."/".$imageName;
					move_uploaded_file($datos['tmp_name'], $dir);
					$this->request->data['Mycar']['foto4'] = $dir;
			}else{
				unset($this->request->data['Mycar']['foto4']);
			}

			if ($this->Mycar->save($this->request->data)) {
				$this->Mycarservicio->deleteAll(array('Mycarservicio.mycar_id'=>$id));
				$this->Mycartag->deleteAll(array('Mycartag.mycar_id'=>$id));
				$stop = 0;
				if(!empty($this->request->data["Afiliado"]["Modulos"])){
					foreach($this->request->data["Afiliado"]["Modulos"] as $modulo){
						$this->request->data["Mycarservicio"]["mycar_id"]        = $id;
						$this->request->data["Mycarservicio"]["categoria_id"]    = $modulo['tipo'];
						$this->request->data["Mycarservicio"]["categoriasub_id"] = $modulo['servicio'];
						$this->Mycarservicio->create();
						if ($this->Mycarservicio->save($this->request->data)) {

						}else{
							$stop = 1;
						}
					}
				}
				if(!empty($this->request->data["Afiliado"]["Modulos2"])){
					foreach($this->request->data["Afiliado"]["Modulos2"] as $modulo){
						$this->request->data["Mycartag"]["mycar_id"]     = $id;
						$this->request->data["Mycartag"]["denominacion"] = $modulo['denominacion'];
						$this->Mycartag->create();
						if ($this->Mycartag->save($this->request->data)) {

						}else{
							$stop = 1;
						}
					}
				}
				$this->Flash->success(__('Registro Guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('Registro no Guardado. Por favor, inténtelo de nuevo.'));
			}
		} else {
			$options = array('conditions' => array('Mycar.' . $this->Mycar->primaryKey => $id));
			$this->request->data = $this->Mycar->find('first', $options);
		}

		$categorias = $this->Categoria->find('all', array('conditions'=>array('Categoria.activo'=>1)));
		$categoriasubs = $this->Categoriasub->find('all', array('conditions'=>array('Categoriasub.activo'=>1)));
		$mycartipos = $this->Mycar->Mycartipo->find('list', array('conditions'=>array('Mycartipo.activo'=>1)));
		$mycarservicios = $this->Mycarservicio->find('all', array('conditions'=>array('mycar_id'=>$id)));
		$mycartags = $this->Mycartag->find('all', array('conditions'=>array('mycar_id'=>$id)));
		$roles = $this->Role->find('list');
		$this->set(compact('roles', 'mycartags', 'mycartipos', 'categorias', 'categoriasubs', 'mycarservicios'));
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
        $this->request->data['Mycar']['id']     = $id;
	    $this->request->data['Mycar']['activo'] = 2;
	}


	public function categoriasub($var1=null, $id=null) {
		$this->layout="ajax";
		$categoriasubs = $this->Categoriasub->find('all', array('conditions'=>array('Categoriasub.categoria_id'=>$id, 'Categoriasub.activo'=>1)));
		$this->set('categoriasubs', $categoriasubs);
		$this->set('var', $var1);
	}
}
