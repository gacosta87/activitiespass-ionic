<?php
App::uses('Gastosubtipo', 'Model');

/**
 * Gastosubtipo Test Case
 *
 */
class GastosubtipoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.gastosubtipo',
		'app.empresa',
		'app.direpai',
		'app.direprovincia',
		'app.empresasurcusale',
		'app.user',
		'app.role',
		'app.rolesmodulo',
		'app.modulo',
		'app.estatus',
		'app.usermodulo',
		'app.gastotipo',
		'app.gasto'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Gastosubtipo = ClassRegistry::init('Gastosubtipo');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Gastosubtipo);

		parent::tearDown();
	}

}
