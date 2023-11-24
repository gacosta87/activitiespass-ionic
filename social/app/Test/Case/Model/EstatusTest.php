<?php
App::uses('Estatus', 'Model');

/**
 * Estatus Test Case
 *
 */
class EstatusTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.estatus'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Estatus = ClassRegistry::init('Estatus');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Estatus);

		parent::tearDown();
	}

}
