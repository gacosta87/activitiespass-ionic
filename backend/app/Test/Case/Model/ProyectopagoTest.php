<?php
App::uses('Proyectopago', 'Model');

/**
 * Proyectopago Test Case
 *
 */
class ProyectopagoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.proyectopago',
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
		'app.nominapersonale'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Proyectopago = ClassRegistry::init('Proyectopago');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Proyectopago);

		parent::tearDown();
	}

}
