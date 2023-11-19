<?php
App::uses('Historia', 'Model');

/**
 * Historia Test Case
 *
 */
class HistoriaTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.historia'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Historia = ClassRegistry::init('Historia');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Historia);

		parent::tearDown();
	}

}
