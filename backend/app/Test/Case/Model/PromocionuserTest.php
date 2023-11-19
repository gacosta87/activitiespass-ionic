<?php
App::uses('Promocionuser', 'Model');

/**
 * Promocionuser Test Case
 *
 */
class PromocionuserTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.promocionuser',
		'app.promocione',
		'app.user',
		'app.role',
		'app.rolesmodulo',
		'app.modulo',
		'app.estatus',
		'app.empresa',
		'app.empresasurcusale',
		'app.usermodulo'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Promocionuser = ClassRegistry::init('Promocionuser');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Promocionuser);

		parent::tearDown();
	}

}
