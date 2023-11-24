<?php
App::uses('Confafiliacione', 'Model');

/**
 * Confafiliacione Test Case
 *
 */
class ConfafiliacioneTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.confafiliacione'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Confafiliacione = ClassRegistry::init('Confafiliacione');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Confafiliacione);

		parent::tearDown();
	}

}
