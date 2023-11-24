<?php
App::uses('Afiliadostarjeta', 'Model');

/**
 * Afiliadostarjeta Test Case
 *
 */
class AfiliadostarjetaTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.afiliadostarjeta',
		'app.afiliado',
		'app.user',
		'app.empleado',
		'app.estatus',
		'app.role',
		'app.membresia',
		'app.estatu',
		'app.afiliadodireccione',
		'app.afiliadoemail',
		'app.afiliadotelefono',
		'app.banco',
		'app.tarjta'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Afiliadostarjeta = ClassRegistry::init('Afiliadostarjeta');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Afiliadostarjeta);

		parent::tearDown();
	}

}
