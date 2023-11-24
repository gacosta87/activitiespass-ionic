<?php
App::uses('Gastotipo', 'Model');

/**
 * Gastotipo Test Case
 *
 */
class GastotipoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.gastotipo',
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
		'app.gasto',
		'app.gastosubtipo'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Gastotipo = ClassRegistry::init('Gastotipo');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Gastotipo);

		parent::tearDown();
	}

}
