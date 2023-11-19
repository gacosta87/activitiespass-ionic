<?php
App::uses('Servicio', 'Model');

/**
 * Servicio Test Case
 *
 */
class ServicioTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.servicio',
		'app.tiposervicio',
		'app.listadouserservicio',
		'app.empresa',
		'app.empresatipo',
		'app.afiliacion',
		'app.empresasurcusale',
		'app.user',
		'app.role',
		'app.rolesmodulo',
		'app.modulo',
		'app.estatus',
		'app.usermodulo'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Servicio = ClassRegistry::init('Servicio');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Servicio);

		parent::tearDown();
	}

}
