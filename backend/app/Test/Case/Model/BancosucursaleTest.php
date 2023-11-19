<?php
App::uses('Bancosucursale', 'Model');

/**
 * Bancosucursale Test Case
 *
 */
class BancosucursaleTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.bancosucursale',
		'app.empresa',
		'app.direpai',
		'app.direprovincia',
		'app.moneda',
		'app.proyectopago',
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
		'app.nominapersonale',
		'app.bancotipo',
		'app.bancocuenta',
		'app.gasto',
		'app.gastotipo',
		'app.gastosubtipo'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Bancosucursale = ClassRegistry::init('Bancosucursale');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Bancosucursale);

		parent::tearDown();
	}

}
