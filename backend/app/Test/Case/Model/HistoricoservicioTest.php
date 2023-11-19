<?php
App::uses('Historicoservicio', 'Model');

/**
 * Historicoservicio Test Case
 *
 */
class HistoricoservicioTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.historicoservicio',
		'app.empresa',
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
		$this->Historicoservicio = ClassRegistry::init('Historicoservicio');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Historicoservicio);

		parent::tearDown();
	}

}
