<?php
App::uses('Reserhabitacione', 'Model');

/**
 * Reserhabitacione Test Case
 *
 */
class ReserhabitacioneTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.reserhabitacione',
		'app.reserhabitaciontipo',
		'app.reserhabitacionstatu'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Reserhabitacione = ClassRegistry::init('Reserhabitacione');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Reserhabitacione);

		parent::tearDown();
	}

}
