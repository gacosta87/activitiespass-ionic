<?php
App::uses('Beautypoint', 'Model');

/**
 * Beautypoint Test Case
 *
 */
class BeautypointTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.beautypoint',
		'app.user',
		'app.role',
		'app.rolesmodulo',
		'app.modulo',
		'app.estatus',
		'app.empresa',
		'app.empresasurcusale',
		'app.usermodulo'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Beautypoint = ClassRegistry::init('Beautypoint');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Beautypoint);

		parent::tearDown();
	}

}
