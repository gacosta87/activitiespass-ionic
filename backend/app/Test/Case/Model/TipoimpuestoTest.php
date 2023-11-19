<?php
App::uses('Tipoimpuesto', 'Model');

/**
 * Tipoimpuesto Test Case
 *
 */
class TipoimpuestoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.tipoimpuesto',
		'app.reservasfacturacione'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Tipoimpuesto = ClassRegistry::init('Tipoimpuesto');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Tipoimpuesto);

		parent::tearDown();
	}

}
