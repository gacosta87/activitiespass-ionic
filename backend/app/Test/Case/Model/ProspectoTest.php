<?php
App::uses('Prospecto', 'Model');

/**
 * Prospecto Test Case
 *
 */
class ProspectoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.prospecto',
		'app.prospectolote',
		'app.estatu'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Prospecto = ClassRegistry::init('Prospecto');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Prospecto);

		parent::tearDown();
	}

}
