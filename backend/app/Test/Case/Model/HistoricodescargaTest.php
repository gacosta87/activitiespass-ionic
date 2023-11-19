<?php
App::uses('Historicodescarga', 'Model');

/**
 * Historicodescarga Test Case
 *
 */
class HistoricodescargaTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.historicodescarga'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Historicodescarga = ClassRegistry::init('Historicodescarga');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Historicodescarga);

		parent::tearDown();
	}

}
