<?php
App::uses('Informacione', 'Model');

/**
 * Informacione Test Case
 *
 */
class InformacioneTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.informacione'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Informacione = ClassRegistry::init('Informacione');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Informacione);

		parent::tearDown();
	}

}
