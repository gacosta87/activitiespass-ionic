<?php
App::uses('Proyectotarea', 'Model');

/**
 * Proyectotarea Test Case
 *
 */
class ProyectotareaTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.proyectotarea',
		'app.empresa',
		'app.direpai',
		'app.direprovincia',
		'app.empresasurcusale',
		'app.user',
		'app.role',
		'app.rolesmodulo',
		'app.modulo',
		'app.estatus',
		'app.usermodulo',
		'app.proyecto',
		'app.proyectotipo',
		'app.cliente',
		'app.dirmunicipio',
		'app.moneda',
		'app.proyectopago',
		'app.nominapersonale'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Proyectotarea = ClassRegistry::init('Proyectotarea');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Proyectotarea);

		parent::tearDown();
	}

}
