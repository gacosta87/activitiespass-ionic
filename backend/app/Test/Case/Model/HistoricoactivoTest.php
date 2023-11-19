<?php
App::uses('Historicoactivo', 'Model');

/**
 * Historicoactivo Test Case
 *
 */
class HistoricoactivoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.historicoactivo',
		'app.user',
		'app.role',
		'app.rolesmodulo',
		'app.modulo',
		'app.estatus',
		'app.empresa',
		'app.empresasurcusale',
		'app.usermodulo'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Historicoactivo = ClassRegistry::init('Historicoactivo');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Historicoactivo);

		parent::tearDown();
	}

}
