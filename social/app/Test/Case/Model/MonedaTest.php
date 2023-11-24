<?php
App::uses('Moneda', 'Model');

/**
 * Moneda Test Case
 *
 */
class MonedaTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.moneda'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Moneda = ClassRegistry::init('Moneda');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Moneda);

		parent::tearDown();
	}

}
