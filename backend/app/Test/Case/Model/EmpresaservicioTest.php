<?php
App::uses('Empresaservicio', 'Model');

/**
 * Empresaservicio Test Case
 *
 */
class EmpresaservicioTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.empresaservicio',
		'app.empresa',
		'app.empresasurcusale',
		'app.user',
		'app.role',
		'app.rolesmodulo',
		'app.modulo',
		'app.estatus',
		'app.usermodulo',
		'app.tiposervicio',
		'app.listadouserservicio'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Empresaservicio = ClassRegistry::init('Empresaservicio');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Empresaservicio);

		parent::tearDown();
	}

}
