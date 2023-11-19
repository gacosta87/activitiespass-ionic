<?php
App::uses('Organizate', 'Model');

/**
 * Organizate Test Case
 *
 */
class OrganizateTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.organizate'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Organizate = ClassRegistry::init('Organizate');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Organizate);

		parent::tearDown();
	}

}
