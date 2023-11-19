<?php
App::uses('Afiliadodireccione', 'Model');

/**
 * Afiliadodireccione Test Case
 *
 */
class AfiliadodireccioneTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.afiliadodireccione',
		'app.afiliado',
		'app.user',
		'app.empleado',
		'app.estatus',
		'app.role',
		'app.membresia',
		'app.estatu',
		'app.afiliadoemail',
		'app.afiliadostarjeta',
		'app.afiliadotelefono'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Afiliadodireccione = ClassRegistry::init('Afiliadodireccione');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Afiliadodireccione);

		parent::tearDown();
	}

}
