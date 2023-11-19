<?php
App::uses('Actucicali', 'Model');

/**
 * Actucicali Test Case
 *
 */
class ActucicaliTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.actucicali'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Actucicali = ClassRegistry::init('Actucicali');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Actucicali);

		parent::tearDown();
	}

}
