<?php
App::uses('Preguntasfrecuente', 'Model');

/**
 * Preguntasfrecuente Test Case
 *
 */
class PreguntasfrecuenteTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.preguntasfrecuente'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Preguntasfrecuente = ClassRegistry::init('Preguntasfrecuente');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Preguntasfrecuente);

		parent::tearDown();
	}

}
