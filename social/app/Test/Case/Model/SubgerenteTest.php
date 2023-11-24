<?php
App::uses('Subgerente', 'Model');

/**
 * Subgerente Test Case
 *
 */
class SubgerenteTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.subgerente',
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
		'app.gerente',
		'app.seccione',
		'app.cargo'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Subgerente = ClassRegistry::init('Subgerente');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Subgerente);

		parent::tearDown();
	}

}
