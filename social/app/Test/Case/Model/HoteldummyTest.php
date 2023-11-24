<?php
App::uses('Hoteldummy', 'Model');

/**
 * Hoteldummy Test Case
 *
 */
class HoteldummyTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.hoteldummy',
		'app.provincia',
		'app.colore'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Hoteldummy = ClassRegistry::init('Hoteldummy');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Hoteldummy);

		parent::tearDown();
	}

}
