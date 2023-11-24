<?php
App::uses('Tipocertificado', 'Model');

/**
 * Tipocertificado Test Case
 *
 */
class TipocertificadoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.tipocertificado'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Tipocertificado = ClassRegistry::init('Tipocertificado');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Tipocertificado);

		parent::tearDown();
	}

}
