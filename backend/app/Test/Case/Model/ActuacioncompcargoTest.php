<?php
App::uses('Actuacioncompcargo', 'Model');

/**
 * Actuacioncompcargo Test Case
 *
 */
class ActuacioncompcargoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.actuacioncompcargo',
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
		'app.actuacioncompetenciatipo',
		'app.actuacioncompetencia',
		'app.nominatipo',
		'app.nominaclaspersonale',
		'app.nominacargo',
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
		'app.nominaficha',
		'app.nominastatus'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Actuacioncompcargo = ClassRegistry::init('Actuacioncompcargo');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Actuacioncompcargo);

		parent::tearDown();
	}

}
