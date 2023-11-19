<?php
App::uses('Membresia', 'Model');

/**
 * Membresia Test Case
 *
 */
class MembresiaTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.membresia'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Membresia = ClassRegistry::init('Membresia');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Membresia);

		parent::tearDown();
	}

}
