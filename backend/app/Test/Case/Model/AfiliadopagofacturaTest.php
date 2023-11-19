<?php
App::uses('Afiliadopagofactura', 'Model');

/**
 * Afiliadopagofactura Test Case
 *
 */
class AfiliadopagofacturaTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.afiliadopagofactura',
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
		'app.tipotelefono'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Afiliadopagofactura = ClassRegistry::init('Afiliadopagofactura');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Afiliadopagofactura);

		parent::tearDown();
	}

}
