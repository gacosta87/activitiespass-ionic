<?php
App::uses('Nominapersonale', 'Model');

/**
 * Nominapersonale Test Case
 *
 */
class NominapersonaleTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.nominapersonale',
		'app.direpai',
		'app.direprovincia',
		'app.empresa',
		'app.empresasurcusale',
		'app.user',
		'app.role',
		'app.rolesmodulo',
		'app.modulo',
		'app.estatus',
		'app.usermodulo',
		'app.dirmunicipio'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Nominapersonale = ClassRegistry::init('Nominapersonale');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Nominapersonale);

		parent::tearDown();
	}

}
