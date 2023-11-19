<?php
App::uses('Hotele', 'Model');

/**
 * Hotele Test Case
 *
 */
class HoteleTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.hotele',
		'app.moneda'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Hotele = ClassRegistry::init('Hotele');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Hotele);

		parent::tearDown();
	}

}
