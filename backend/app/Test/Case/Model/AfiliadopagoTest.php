<?php
App::uses('Afiliadopago', 'Model');

/**
 * Afiliadopago Test Case
 *
 */
class AfiliadopagoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.afiliadopago',
		'app.afiliado',
		'app.user',
		'app.empleado',
		'app.estatus',
		'app.role',
		'app.membresia',
		'app.afiliadodireccione',
		'app.afiliadoemail',
		'app.afiliadostarjeta',
		'app.banco',
		'app.tarjeta',
		'app.afiliadotelefono',
		'app.tipotelefono',
		'app.tipocomprobante'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Afiliadopago = ClassRegistry::init('Afiliadopago');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Afiliadopago);

		parent::tearDown();
	}

}
