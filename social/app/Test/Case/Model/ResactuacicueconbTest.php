<?php
App::uses('Resactuacicueconb', 'Model');

/**
 * Resactuacicueconb Test Case
 *
 */
class ResactuacicueconbTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.resactuacicueconb',
		'app.resactuacicuecona',
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
		'app.usermodulo',
		'app.actucieva',
		'app.actucievacali',
		'app.actucievarevi',
		'app.organigrama1',
		'app.organigrama10',
		'app.organigrama2',
		'app.organigrama3',
		'app.organigrama4',
		'app.organigrama5',
		'app.organigrama6',
		'app.organigrama7',
		'app.organigrama8',
		'app.organigrama9',
		'app.actucievaapli',
		'app.nominatipo',
		'app.nominaclaspersonale',
		'app.nominacargo',
		'app.nominaficha',
		'app.nominastatus',
		'app.actuacicue',
		'app.actuacioncompetenciatipo',
		'app.actuacioncompetencia',
		'app.actucicali'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Resactuacicueconb = ClassRegistry::init('Resactuacicueconb');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Resactuacicueconb);

		parent::tearDown();
	}

}
