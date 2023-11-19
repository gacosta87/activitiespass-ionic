<?php
App::uses('Beautypointstipo', 'Model');

/**
 * Beautypointstipo Test Case
 *
 */
class BeautypointstipoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.beautypointstipo',
		'app.beautypoint',
		'app.user',
		'app.role',
		'app.rolesmodulo',
		'app.modulo',
		'app.estatus',
		'app.empresa',
		'app.empresatipo',
		'app.afiliacion',
		'app.empresasurcusale',
		'app.usermodulo',
		'app.reserva',
		'app.calificacioncuerpo',
		'app.calificacione',
		'app.calificaciontipo',
		'app.reservadetalle',
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
		$this->Beautypointstipo = ClassRegistry::init('Beautypointstipo');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Beautypointstipo);

		parent::tearDown();
	}

}
