<?php
App::uses('Reservacione', 'Model');

/**
 * Reservacione Test Case
 *
 */
class ReservacioneTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.reservacione',
		'app.afiliado',
		'app.user',
		'app.empleado',
		'app.estatus',
		'app.role',
		'app.usermodulo',
		'app.modulo',
		'app.membresia',
		'app.afiliadodireccione',
		'app.afiliadoemail',
		'app.afiliadostarjeta',
		'app.banco',
		'app.tarjeta',
		'app.afiliadotelefono',
		'app.tipotelefono',
		'app.reserhabitaciontipo',
		'app.reserhabitacione',
		'app.reserhabitacionstatus',
		'app.reserhabitacionstatu',
		'app.resermultiple'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Reservacione = ClassRegistry::init('Reservacione');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Reservacione);

		parent::tearDown();
	}

}
