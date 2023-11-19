<?php
App::uses('Tipodescuento', 'Model');

/**
 * Tipodescuento Test Case
 *
 */
class TipodescuentoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.tipodescuento',
		'app.reservasfacturacione'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Tipodescuento = ClassRegistry::init('Tipodescuento');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Tipodescuento);

		parent::tearDown();
	}

}
