<?php
App::uses('Beautip', 'Model');

/**
 * Beautip Test Case
 *
 */
class BeautipTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.beautip'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Beautip = ClassRegistry::init('Beautip');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Beautip);

		parent::tearDown();
	}

}
