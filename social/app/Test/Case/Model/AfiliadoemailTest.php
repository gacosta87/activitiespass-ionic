<?php
App::uses('Afiliadoemail', 'Model');

/**
 * Afiliadoemail Test Case
 *
 */
class AfiliadoemailTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.afiliadoemail',
		'app.afiliado',
		'app.user',
		'app.empleado',
		'app.estatus',
		'app.role',
		'app.membresia',
		'app.estatu',
		'app.afiliadodireccione',
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
		$this->Afiliadoemail = ClassRegistry::init('Afiliadoemail');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Afiliadoemail);

		parent::tearDown();
	}

}
