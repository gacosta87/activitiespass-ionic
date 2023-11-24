<?php
App::uses('Actuacioncompetencia', 'Model');

/**
 * Actuacioncompetencia Test Case
 *
 */
class ActuacioncompetenciaTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.actuacioncompetencia',
		'app.empresa',
		'app.direpai',
		'app.direprovincia',
		'app.moneda',
		'app.proyectopago',
		'app.proyecto',
		'app.empresasurcusale',
		'app.user',
		'app.role',
		'app.rolesmodulo',
		'app.modulo',
		'app.estatus',
		'app.nominapersonale',
		'app.dirmunicipio',
		'app.cliente',
		'app.usermodulo',
		'app.actuacioncompetenciatipo'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Actuacioncompetencia = ClassRegistry::init('Actuacioncompetencia');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Actuacioncompetencia);

		parent::tearDown();
	}

}
