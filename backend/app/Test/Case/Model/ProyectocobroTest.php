<?php
App::uses('Proyectocobro', 'Model');

/**
 * Proyectocobro Test Case
 *
 */
class ProyectocobroTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.proyectocobro',
		'app.empresa',
		'app.direpai',
		'app.direprovincia',
		'app.empresasurcusale',
		'app.user',
		'app.role',
		'app.rolesmodulo',
		'app.modulo',
		'app.estatus',
		'app.usermodulo',
		'app.proyecto',
		'app.proyectotipo',
		'app.cliente',
		'app.dirmunicipio',
		'app.moneda',
		'app.proyectopago',
		'app.nominapersonale'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Proyectocobro = ClassRegistry::init('Proyectocobro');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Proyectocobro);

		parent::tearDown();
	}

}
