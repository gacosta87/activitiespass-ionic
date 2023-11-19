<?php
App::uses('Calificacione', 'Model');

/**
 * Calificacione Test Case
 *
 */
class CalificacioneTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.calificacione',
		'app.empresa',
		'app.empresasurcusale',
		'app.user',
		'app.role',
		'app.rolesmodulo',
		'app.modulo',
		'app.estatus',
		'app.usermodulo',
		'app.calificaciontipo'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Calificacione = ClassRegistry::init('Calificacione');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Calificacione);

		parent::tearDown();
	}

}
