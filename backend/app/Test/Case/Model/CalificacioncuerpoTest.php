<?php
App::uses('Calificacioncuerpo', 'Model');

/**
 * Calificacioncuerpo Test Case
 *
 */
class CalificacioncuerpoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.calificacioncuerpo',
		'app.empresa',
		'app.empresasurcusale',
		'app.user',
		'app.role',
		'app.rolesmodulo',
		'app.modulo',
		'app.estatus',
		'app.usermodulo',
		'app.reserva',
		'app.calificacione',
		'app.calificaciontipo'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Calificacioncuerpo = ClassRegistry::init('Calificacioncuerpo');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Calificacioncuerpo);

		parent::tearDown();
	}

}
