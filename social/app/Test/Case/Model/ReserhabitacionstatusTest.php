<?php
App::uses('Reserhabitacionstatus', 'Model');

/**
 * Reserhabitacionstatus Test Case
 *
 */
class ReserhabitacionstatusTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.reserhabitacionstatus'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Reserhabitacionstatus = ClassRegistry::init('Reserhabitacionstatus');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Reserhabitacionstatus);

		parent::tearDown();
	}

}
