<?php
App::uses('Recargasgifcard', 'Model');

/**
 * Recargasgifcard Test Case
 *
 */
class RecargasgifcardTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.recargasgifcard'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Recargasgifcard = ClassRegistry::init('Recargasgifcard');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Recargasgifcard);

		parent::tearDown();
	}

}
