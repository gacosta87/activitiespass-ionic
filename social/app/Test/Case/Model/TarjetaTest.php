<?php
App::uses('Tarjeta', 'Model');

/**
 * Tarjeta Test Case
 *
 */
class TarjetaTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.tarjeta'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Tarjeta = ClassRegistry::init('Tarjeta');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Tarjeta);

		parent::tearDown();
	}

}
