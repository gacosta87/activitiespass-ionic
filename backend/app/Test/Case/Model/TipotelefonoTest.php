<?php
App::uses('Tipotelefono', 'Model');

/**
 * Tipotelefono Test Case
 *
 */
class TipotelefonoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.tipotelefono',
		'app.afiliadotelefono'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Tipotelefono = ClassRegistry::init('Tipotelefono');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Tipotelefono);

		parent::tearDown();
	}

}
