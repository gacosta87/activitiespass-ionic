<?php
App::uses('Tipoextra', 'Model');

/**
 * Tipoextra Test Case
 *
 */
class TipoextraTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.tipoextra',
		'app.reservasfacturacione'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Tipoextra = ClassRegistry::init('Tipoextra');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Tipoextra);

		parent::tearDown();
	}

}
