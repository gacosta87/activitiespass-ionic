<?php
App::uses('Tipocomprobante', 'Model');

/**
 * Tipocomprobante Test Case
 *
 */
class TipocomprobanteTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.tipocomprobante'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Tipocomprobante = ClassRegistry::init('Tipocomprobante');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Tipocomprobante);

		parent::tearDown();
	}

}
