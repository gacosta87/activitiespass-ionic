<?php
App::uses('Nfc', 'Model');

/**
 * Nfc Test Case
 *
 */
class NfcTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.nfc',
		'app.tipocomprobante'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Nfc = ClassRegistry::init('Nfc');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Nfc);

		parent::tearDown();
	}

}
