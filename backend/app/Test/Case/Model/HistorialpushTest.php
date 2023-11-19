<?php
App::uses('Historialpush', 'Model');

/**
 * Historialpush Test Case
 *
 */
class HistorialpushTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.historialpush'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Historialpush = ClassRegistry::init('Historialpush');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Historialpush);

		parent::tearDown();
	}

}
