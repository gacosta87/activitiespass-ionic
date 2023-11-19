<?php
App::uses('Canjesdetalle', 'Model');

/**
 * Canjesdetalle Test Case
 *
 */
class CanjesdetalleTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.canjesdetalle',
		'app.canje',
		'app.user',
		'app.role',
		'app.rolesmodulo',
		'app.modulo',
		'app.estatus',
		'app.empresa',
		'app.empresasurcusale',
		'app.afiliacion',
		'app.usermodulo'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Canjesdetalle = ClassRegistry::init('Canjesdetalle');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Canjesdetalle);

		parent::tearDown();
	}

}
