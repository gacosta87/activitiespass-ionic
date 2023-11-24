<?php
App::uses('Mensaje', 'Model');

/**
 * Mensaje Test Case
 *
 */
class MensajeTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.mensaje',
		'app.empresa',
		'app.direpai',
		'app.direprovincia',
		'app.moneda',
		'app.empresasurcusale',
		'app.user',
		'app.role',
		'app.rolesmodulo',
		'app.modulo',
		'app.estatus',
		'app.nominapersonale',
		'app.dirmunicipio',
		'app.cliente',
		'app.usermodulo'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Mensaje = ClassRegistry::init('Mensaje');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Mensaje);

		parent::tearDown();
	}

}
