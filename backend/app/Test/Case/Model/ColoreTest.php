<?php
App::uses('Colore', 'Model');

/**
 * Colore Test Case
 *
 */
class ColoreTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.colore'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Colore = ClassRegistry::init('Colore');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Colore);

		parent::tearDown();
	}

}
