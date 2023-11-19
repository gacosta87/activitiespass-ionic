<?php
App::uses('Empresaserviciodetalle', 'Model');

/**
 * Empresaserviciodetalle Test Case
 *
 */
class EmpresaserviciodetalleTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.empresaserviciodetalle',
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
		$this->Empresaserviciodetalle = ClassRegistry::init('Empresaserviciodetalle');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Empresaserviciodetalle);

		parent::tearDown();
	}

}
