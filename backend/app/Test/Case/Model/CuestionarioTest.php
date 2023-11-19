<?php
App::uses('Cuestionario', 'Model');

/**
 * Cuestionario Test Case
 *
 */
class CuestionarioTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.cuestionario',
		'app.cuestionariodetalle',
		'app.cuestionariopregunta'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Cuestionario = ClassRegistry::init('Cuestionario');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Cuestionario);

		parent::tearDown();
	}

}
