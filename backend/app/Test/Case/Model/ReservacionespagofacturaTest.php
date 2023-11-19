<?php
App::uses('Reservacionespagofactura', 'Model');

/**
 * Reservacionespagofactura Test Case
 *
 */
class ReservacionespagofacturaTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.reservacionespagofactura',
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
		'app.reserhabitacionstatus'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Reservacionespagofactura = ClassRegistry::init('Reservacionespagofactura');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Reservacionespagofactura);

		parent::tearDown();
	}

}
