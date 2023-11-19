<?php
App::uses('Tiposervicio', 'Model');

/**
 * Tiposervicio Test Case
 *
 */
class TiposervicioTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
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
		$this->Tiposervicio = ClassRegistry::init('Tiposervicio');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Tiposervicio);

		parent::tearDown();
	}

}
