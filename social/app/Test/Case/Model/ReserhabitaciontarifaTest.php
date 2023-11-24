<?php
App::uses('Reserhabitaciontarifa', 'Model');

/**
 * Reserhabitaciontarifa Test Case
 *
 */
class ReserhabitaciontarifaTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.reserhabitaciontarifa',
		'app.reserhabitaciontipo',
		'app.reserhabitacione',
		'app.reserhabitacionstatus'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Reserhabitaciontarifa = ClassRegistry::init('Reserhabitaciontarifa');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Reserhabitaciontarifa);

		parent::tearDown();
	}

}
