<?php
App::uses('Usermodulo', 'Model');

/**
 * Usermodulo Test Case
 *
 */
class UsermoduloTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.usermodulo',
		'app.user',
		'app.empleado',
		'app.estatus',
		'app.role',
		'app.modulo'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Usermodulo = ClassRegistry::init('Usermodulo');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Usermodulo);

		parent::tearDown();
	}

}
