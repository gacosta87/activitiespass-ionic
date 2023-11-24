<?php
App::uses('Departamento', 'Model');

/**
 * Departamento Test Case
 *
 */
class DepartamentoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.departamento',
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
		'app.formulario',
		'app.gerente',
		'app.seccione',
		'app.subgerente'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Departamento = ClassRegistry::init('Departamento');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Departamento);

		parent::tearDown();
	}

}
