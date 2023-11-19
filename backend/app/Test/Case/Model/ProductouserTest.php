<?php
App::uses('Productouser', 'Model');

/**
 * Productouser Test Case
 *
 */
class ProductouserTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.productouser',
		'app.user',
		'app.role',
		'app.rolesmodulo',
		'app.modulo',
		'app.estatus',
		'app.empresa',
		'app.empresasurcusale',
		'app.usermodulo',
		'app.produtotipo'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Productouser = ClassRegistry::init('Productouser');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Productouser);

		parent::tearDown();
	}

}
