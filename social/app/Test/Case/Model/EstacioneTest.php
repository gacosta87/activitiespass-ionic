<?php
App::uses('Estacione', 'Model');

/**
 * Estacione Test Case
 *
 */
class EstacioneTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.estacione'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Estacione = ClassRegistry::init('Estacione');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Estacione);

		parent::tearDown();
	}

}
