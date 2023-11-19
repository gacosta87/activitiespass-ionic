<?php
App::uses('Actuacioncompetenciatipo', 'Model');

/**
 * Actuacioncompetenciatipo Test Case
 *
 */
class ActuacioncompetenciatipoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.actuacioncompetenciatipo',
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
		'app.actuacioncompetencia'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Actuacioncompetenciatipo = ClassRegistry::init('Actuacioncompetenciatipo');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Actuacioncompetenciatipo);

		parent::tearDown();
	}

}
