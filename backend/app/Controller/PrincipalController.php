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
class PrincipalController extends AppController {

	public $components = array('Paginator', 'Session', 'Flash');

	var $uses = array('Mensaje', 'Mycarscomentario', 'Mycarcalificacione', 'Promocione', 'Publicacione', 'Usuario',  'Denuncia', 'Mycar', 'Sugerencia', 'Instalacionapp');

	public function beforeFilter() {
		$this->checkSession();
	}

	function index(){
		$this->layout = "principal";


		$usuariosregistrados = $this->Usuario->find('count', array('conditions'=>array()));
		$this->set("cusuariosregistrados", $usuariosregistrados);

		$instalaccionapp = $this->Instalacionapp->find('count', array('conditions'=>array()));
		$this->set("cinstalaccionapp", $instalaccionapp);


		$asistentes = $this->Mycar->find('count', array('conditions'=>array('Mycar.produtos_servicios_ofrecidos !='=>'')));
		$publicaciones = $this->Publicacione->find('count', array('conditions'=>array('Publicacione.valido'=>1)));
		$usuarios = $this->Usuario->find('count', array('conditions'=>array('Usuario.valido'=>1)));
		$cusuariosaprobacion = $this->Usuario->find('count', array('conditions'=>array('OR' => array('Usuario.verificacion_3'=>'2', 'Usuario.verificacion_4'=>'2','Usuario.verificacion_5'=>'2'))));

		$this->set("casistentes", $asistentes);
		$this->set("cpublicaciones", $publicaciones);
		$this->set("cusuarios", $usuarios);
		$this->set("cusuariosaprobacion", $cusuariosaprobacion);


		$sugerencias = $this->Sugerencia->find('count', array('conditions'=>array('Sugerencia.activo'=>1)));
		$this->set("csugerencias", $sugerencias);


		$mensajes = $this->Mensaje->find('count', array('conditions'=>array('Mensaje.valido'=>1)));
		$this->set("cmensajes", $mensajes);

		$tpublicaciones = $this->Publicacione->find('count', array('conditions'=>array()));
		$this->set("tpublicaciones", $tpublicaciones);

		$tpromociones = $this->Promocione->find('count', array('conditions'=>array()));
		$this->set("tpromociones", $tpromociones);


		$credes = $this->Mycar->find('count', array('conditions'=>array('Mycar.activacion_facebook !='=>'1')));
		$this->set("credes", $credes);

		$cwhatsapp = $this->Mycar->find('count', array('conditions'=>array('Mycar.telefono !='=>'', 'Mycar.codigo_pais !='=>'')));
		$this->set("cwhatsapp", $cwhatsapp);

		$csuscripciones = $this->Mycar->find('count', array('conditions'=>array('Mycar.suscripcion_facebook_activacion'=>'2')));
		$this->set("csuscripciones", $csuscripciones);
		
		

	}














	function index2(){
		$this->layout = "principal";

		$fecha_actual = date("Y-m-d");
		//sumo 7 día
		$sumardias  =  date("Y-m-d",strtotime($fecha_actual."+ 6 days")); 
		//resto 7 día
		$restardias =  date("Y-m-d",strtotime($fecha_actual."- 6 days")); 
		//sumo 3 meses
		$sumarmeses  =  date("Y-m-d",strtotime($fecha_actual."+ 2 month")); 
		//resto 7 meses
		$restarmeses =  date("Y-m",strtotime($fecha_actual."- 2 month")).'-01'; 


		$totalpublicaciones = $this->Publicacione->find('all', array('fields'=>array('Publicacione.created', 'CAST(Publicacione.created as DATE) as fecha'),   'order'=>array('Publicacione.created'=>'asc'),  'conditions'=>array('Publicacione.created BETWEEN "'.$restardias.'" and "'.$fecha_actual.' 23:59:00"')  ));
		$totalpublicaciones2 = array();
		$contar  = -1;
		$bandera = '';
		//pr($totalpublicaciones);
		foreach ($totalpublicaciones as $key) {
				//$key['Publicacione']['created']
			if($bandera!=$key[0]['fecha']){
				$bandera = $key[0]['fecha'];
				$contar++;
			}
			$totalpublicaciones2[$contar]['valor'] = isset($totalpublicaciones2[$contar]['valor'])?$totalpublicaciones2[$contar]['valor']+1:1; 
			$totalpublicaciones2[$contar]['fecha'] = $key[0]['fecha'];

		}
		//pr($totalpublicaciones2);
		$this->set("totalpublicaciones", $totalpublicaciones2);

		$totalusuarios = $this->Usuario->find('all', array('order'=>array('Usuario.fechaingreso'=>'asc'),  'conditions'=>array('Usuario.fechaingreso BETWEEN "'.$restardias.'" and "'.$fecha_actual.'"')  ));
		$totalusuarios2 = array();
		$contar  = -1;
		$bandera = '';
		foreach ($totalusuarios as $key) {
			if($bandera!=$key['Usuario']['fechaingreso']){
				$bandera = $key['Usuario']['fechaingreso'];
				$contar++;
			}
			$totalusuarios2[$contar]['valor'] = isset($totalusuarios2[$contar]['valor'])?$totalusuarios2[$contar]['valor']+1:1; 
			$totalusuarios2[$contar]['fecha'] = $key['Usuario']['fechaingreso'];
		}
		//pr($totalusuarios);
		//pr($totalusuarios2);
		$this->set("totalusuarios", $totalusuarios2);




		$totalusuariosinst = $this->Instalacionapp->find('all', array('fields'=>array('CAST(created AS DATE)'),  'order'=>array('Instalacionapp.created'=>'asc'),  'conditions'=>array('Instalacionapp.created BETWEEN "'.$restardias.'" and "'.$fecha_actual.'"')  ));
		$totalusuariosinst2 = array();
		$contar  = -1;
		$bandera = '';
		//print_r($totalusuariosinst );
		foreach ($totalusuariosinst as $key) {
			if($bandera!=$key[0]['CAST(created AS DATE)']){
				$bandera = $key[0]['CAST(created AS DATE)'];
				$contar++;
			}
			$totalusuariosinst2[$contar]['valor'] = isset($totalusuariosinst2[$contar]['valor'])?$totalusuariosinst2[$contar]['valor']+1:1; 
			$totalusuariosinst2[$contar]['fecha'] = $key[0]['CAST(created AS DATE)'];
		}
		//pr($totalusuarios);
		//pr($totalusuarios2);
		$this->set("totalusuariosinst", $totalusuariosinst2);







		$instalaccionappmeses = $this->Instalacionapp->find('all', array('fields'=>array('Instalacionapp.created', 'CAST(Instalacionapp.created as DATE) as fecha'),   'order'=>array('Instalacionapp.created'=>'asc'),  'conditions'=>array('Instalacionapp.created BETWEEN "'.$restarmeses.'" and "'.$fecha_actual.'"')  ));
		$totalusuariosmeses   = $this->Usuario->find('all',       array('order'=>array('Usuario.fechaingreso'=>'asc'),  'conditions'=>array('Usuario.fechaingreso BETWEEN "'.$restarmeses.'" and "'.$fecha_actual.'"')  ));
		$this->set("instalaccionappmeses", $instalaccionappmeses);
		$this->set("totalusuariosmeses", $totalusuariosmeses);

		$totalinstallvsregistro = array();

		$mes_actual1  = date("m");
		$mes_actual2  = date("m")-1;
		$mes_actual3  = date("m")-2;
		if($mes_actual1==1){
			$mes_actual2 = 12;
			$mes_actual3 = 11;
		}
		if($mes_actual1==2){
			$mes_actual2 = 1;
			$mes_actual3 = 12;
		}
		$totalinstallvsregistro[0]['mes'] = $mes_actual3;
		$totalinstallvsregistro[1]['mes'] = $mes_actual2;
		$totalinstallvsregistro[2]['mes'] = $mes_actual1;

		$contar  = 0;
		$bandera = '';
		$bandera2 = '';
		foreach($totalinstallvsregistro as $vermes){
			foreach ($instalaccionappmeses as $key) {
				$mes  = date("m",strtotime($key[0]['fecha'])); 
				$year = date("Y",strtotime($key[0]['fecha'])); 
					if($vermes['mes']==$mes){
						$totalinstallvsregistro[$contar]['inst']  = isset($totalinstallvsregistro[$contar]['inst'])?$totalinstallvsregistro[$contar]['inst']+1:1; 
					}
			}
			$contar++;
		}
		$contar  = 0;
		$bandera = '';
		$bandera2 = '';
		foreach($totalinstallvsregistro as $vermes){
				foreach ($totalusuariosmeses as $key) {
						$mes  = date("m",strtotime($key['Usuario']['fechaingreso'])); 
						$year = date("Y",strtotime($key['Usuario']['fechaingreso'])); 
						if($vermes['mes']==$mes){
							$totalinstallvsregistro[$contar]['regis'] = isset($totalinstallvsregistro[$contar]['regis'])?$totalinstallvsregistro[$contar]['regis']+1:1; 
						}
				}
				$contar++;
		}
		
		//pr($instalaccionappmeses);
		//pr($totalusuariosmeses);
		//pr($totalinstallvsregistro);
		$this->set("totalinstallvsregistro", $totalinstallvsregistro);



	}




	function index3(){
		$this->layout = "principal";

		$mensajes = $this->Mensaje->find('count', array('conditions'=>array('Mensaje.valido'=>1)));
		$this->set("cmensajes", $mensajes);

		$calificaciones = $this->Mycarcalificacione->find('count', array('conditions'=>array('Mycarcalificacione.valido'=>1)));
		$this->set("ccalificaciones", $calificaciones);

		$comentarios = $this->Mycarscomentario->find('count', array('conditions'=>array('Mycarscomentario.valido'=>1)));
		$this->set("ccomentarios", $comentarios);

		$denuncacias = $this->Denuncia->find('count', array('conditions'=>array('Denuncia.valido'=>1)));
		$this->set("cdenuncacias", $denuncacias);


		/*$totalusuariossinpubli = $this->Usuario->find('all', array('order'=>array('Usuario.fechaingreso'=>'asc'),  'conditions'=>array()));
		$contar  = 0;
		$contar2  = 0;
		foreach ($totalusuariossinpubli as $key) {
			if(!isset($key['Publicacione'][0]['id'])){
				$contar++;
			}
			$contar2++;
		}
		$this->set("totalusuariossinpubli", $contar);
		$this->set("cusuariosregistrados",  $contar2);	*/

	}


}
?>