<?php
App::uses('Reservadetalle', 'Model');

/**
 * Reservadetalle Test Case
 *
 */
class ReservadetalleTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.reservadetalle',
		'app.reseva',
		'app.tiposervicio',
		'app.listadouserservicio',
		'app.empresa',
		'app.empresasurcusale',
		'app.user',
		'app.role',
		'app.rolesmodulo',
		'app.modulo',
		'app.estatus',
		'app.usermodulo'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Reservadetalle = ClassRegistry::init('Reservadetalle');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Reservadetalle);

		parent::tearDown();
	}

}
