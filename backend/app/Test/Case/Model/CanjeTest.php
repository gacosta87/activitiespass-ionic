<?php
App::uses('Canje', 'Model');

/**
 * Canje Test Case
 *
 */
class CanjeTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.canje',
		'app.canjesdetalle'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Canje = ClassRegistry::init('Canje');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Canje);

		parent::tearDown();
	}

}
