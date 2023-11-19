<?php
App::uses('Afiliadotipopago', 'Model');

/**
 * Afiliadotipopago Test Case
 *
 */
class AfiliadotipopagoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.afiliadotipopago',
		'app.afiliadopago',
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
		'app.tipocomprobante',
		'app.estacione'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Afiliadotipopago = ClassRegistry::init('Afiliadotipopago');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Afiliadotipopago);

		parent::tearDown();
	}

}
