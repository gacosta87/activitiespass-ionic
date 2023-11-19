<?php
App::uses('Tiporecarga', 'Model');

/**
 * Tiporecarga Test Case
 *
 */
class TiporecargaTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.tiporecarga',
		'app.recarga'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Tiporecarga = ClassRegistry::init('Tiporecarga');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Tiporecarga);

		parent::tearDown();
	}

}
