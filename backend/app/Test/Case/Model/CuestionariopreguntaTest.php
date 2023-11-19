<?php
App::uses('Cuestionariopregunta', 'Model');

/**
 * Cuestionariopregunta Test Case
 *
 */
class CuestionariopreguntaTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.cuestionariopregunta',
		'app.cuestionario',
		'app.cuestionariodetalle'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Cuestionariopregunta = ClassRegistry::init('Cuestionariopregunta');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Cuestionariopregunta);

		parent::tearDown();
	}

}
