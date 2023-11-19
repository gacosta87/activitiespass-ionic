<?php
App::uses('Abogado', 'Model');

/**
 * Abogado Test Case
 *
 */
class AbogadoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.abogado'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Abogado = ClassRegistry::init('Abogado');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Abogado);

		parent::tearDown();
	}

}
