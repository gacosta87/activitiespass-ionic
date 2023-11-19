<?php
App::uses('Rolesmodulo', 'Model');

/**
 * Rolesmodulo Test Case
 *
 */
class RolesmoduloTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.rolesmodulo',
		'app.role',
		'app.user',
		'app.empleado',
		'app.estatus',
		'app.usermodulo',
		'app.modulo'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Rolesmodulo = ClassRegistry::init('Rolesmodulo');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Rolesmodulo);

		parent::tearDown();
	}

}
