<?php
App::uses('Empleado', 'Model');

/**
 * Empleado Test Case
 *
 */
class EmpleadoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.empleado',
		'app.estatu'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Empleado = ClassRegistry::init('Empleado');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Empleado);

		parent::tearDown();
	}

}
