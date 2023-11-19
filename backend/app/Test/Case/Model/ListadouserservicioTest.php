<?php
App::uses('Listadouserservicio', 'Model');

/**
 * Listadouserservicio Test Case
 *
 */
class ListadouserservicioTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.listadouserservicio',
		'app.user',
		'app.role',
		'app.rolesmodulo',
		'app.modulo',
		'app.estatus',
		'app.empresa',
		'app.empresasurcusale',
		'app.usermodulo',
		'app.tiposervicio'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Listadouserservicio = ClassRegistry::init('Listadouserservicio');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Listadouserservicio);

		parent::tearDown();
	}

}
