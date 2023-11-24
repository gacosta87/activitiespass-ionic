<?php
App::uses('Afiliado', 'Model');

/**
 * Afiliado Test Case
 *
 */
class AfiliadoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.afiliado',
		'app.user',
		'app.empleado',
		'app.estatus',
		'app.role',
		'app.membresia',
		'app.estatu',
		'app.afiliadodireccione',
		'app.afiliadoemail',
		'app.afiliadostarjeta',
		'app.afiliadotelefono'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Afiliado = ClassRegistry::init('Afiliado');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Afiliado);

		parent::tearDown();
	}

}
