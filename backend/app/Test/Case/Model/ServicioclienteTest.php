<?php
App::uses('Serviciocliente', 'Model');

/**
 * Serviciocliente Test Case
 *
 */
class ServicioclienteTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.serviciocliente'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Serviciocliente = ClassRegistry::init('Serviciocliente');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Serviciocliente);

		parent::tearDown();
	}

}
