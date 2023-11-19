<?php
App::uses('Reserhabitaciontipo', 'Model');

/**
 * Reserhabitaciontipo Test Case
 *
 */
class ReserhabitaciontipoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.reserhabitaciontipo',
		'app.reserhabitacione'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Reserhabitaciontipo = ClassRegistry::init('Reserhabitaciontipo');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Reserhabitaciontipo);

		parent::tearDown();
	}

}
