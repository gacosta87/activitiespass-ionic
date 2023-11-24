<?php
App::uses('Gerente', 'Model');

/**
 * Gerente Test Case
 *
 */
class GerenteTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.gerente',
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
		'app.departamento',
		'app.formulario',
		'app.seccione',
		'app.subgerente',
		'app.cargo'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Gerente = ClassRegistry::init('Gerente');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Gerente);

		parent::tearDown();
	}

}
