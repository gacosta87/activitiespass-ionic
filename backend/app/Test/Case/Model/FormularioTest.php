<?php
App::uses('Formulario', 'Model');

/**
 * Formulario Test Case
 *
 */
class FormularioTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.formulario',
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
		'app.gerente',
		'app.seccione',
		'app.subgerente',
		'app.cargo',
		'app.sistema',
		'app.cargo_actual',
		'app.cargo_nuevo',
		'app.statuspas'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Formulario = ClassRegistry::init('Formulario');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Formulario);

		parent::tearDown();
	}

}
