<?php
App::uses('Aplicarfactura', 'Model');

/**
 * Aplicarfactura Test Case
 *
 */
class AplicarfacturaTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.aplicarfactura'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Aplicarfactura = ClassRegistry::init('Aplicarfactura');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Aplicarfactura);

		parent::tearDown();
	}

}
