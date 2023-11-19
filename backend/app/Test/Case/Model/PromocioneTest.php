<?php
App::uses('Promocione', 'Model');

/**
 * Promocione Test Case
 *
 */
class PromocioneTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.promocione',
		'app.promocionuser'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Promocione = ClassRegistry::init('Promocione');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Promocione);

		parent::tearDown();
	}

}
