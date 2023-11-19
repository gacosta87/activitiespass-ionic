<?php
App::uses('Bancotipo', 'Model');

/**
 * Bancotipo Test Case
 *
 */
class BancotipoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.bancotipo',
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
		'app.bancocuenta',
		'app.bancosucursale',
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
		$this->Bancotipo = ClassRegistry::init('Bancotipo');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Bancotipo);

		parent::tearDown();
	}

}
