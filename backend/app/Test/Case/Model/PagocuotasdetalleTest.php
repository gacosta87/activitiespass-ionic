<?php
App::uses('Pagocuotasdetalle', 'Model');

/**
 * Pagocuotasdetalle Test Case
 *
 */
class PagocuotasdetalleTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.pagocuotasdetalle',
		'app.pagocuota',
		'app.pago',
		'app.pagostipo',
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
		$this->Pagocuotasdetalle = ClassRegistry::init('Pagocuotasdetalle');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Pagocuotasdetalle);

		parent::tearDown();
	}

}
