<?php
App::uses('Organigrama8', 'Model');

/**
 * Organigrama8 Test Case
 *
 */
class Organigrama8Test extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.organigrama8',
		'app.empresa',
		'app.direpai',
		'app.direprovincia',
		'app.moneda',
		'app.proyectopago',
		'app.proyecto',
		'app.empresasurcusale',
		'app.user',
		'app.role',
		'app.rolesmodulo',
		'app.modulo',
		'app.estatus',
		'app.nominapersonale',
		'app.dirmunicipio',
		'app.cliente',
		'app.usermodulo',
		'app.organigrama1',
		'app.organigrama10',
		'app.organigrama2',
		'app.organigrama3',
		'app.organigrama4',
		'app.organigrama5',
		'app.organigrama6',
		'app.organigrama7',
		'app.organigrama9'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Organigrama8 = ClassRegistry::init('Organigrama8');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Organigrama8);

		parent::tearDown();
	}

}
