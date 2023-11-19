<?php
App::uses('Bancocuenta', 'Model');

/**
 * Bancocuenta Test Case
 *
 */
class BancocuentaTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.bancocuenta',
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
		$this->Bancocuenta = ClassRegistry::init('Bancocuenta');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Bancocuenta);

		parent::tearDown();
	}

}
