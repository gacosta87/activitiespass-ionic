<?php
App::uses('Cuestionariodetalle', 'Model');

/**
 * Cuestionariodetalle Test Case
 *
 */
class CuestionariodetalleTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.cuestionariodetalle',
		'app.cuestionario',
		'app.cuestionariopregunta'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Cuestionariodetalle = ClassRegistry::init('Cuestionariodetalle');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Cuestionariodetalle);

		parent::tearDown();
	}

}
