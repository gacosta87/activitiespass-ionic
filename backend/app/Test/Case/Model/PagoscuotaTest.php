<?php
App::uses('Pagoscuota', 'Model');

/**
 * Pagoscuota Test Case
 *
 */
class PagoscuotaTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.pagoscuota',
		'app.user',
		'app.role',
		'app.rolesmodulo',
		'app.modulo',
		'app.estatus',
		'app.empresa',
		'app.empresasurcusale',
		'app.userabogado',
		'app.usermodulo'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Pagoscuota = ClassRegistry::init('Pagoscuota');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Pagoscuota);

		parent::tearDown();
	}

}
