<?php
App::uses('Userestado', 'Model');

/**
 * Userestado Test Case
 *
 */
class UserestadoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.userestado'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Userestado = ClassRegistry::init('Userestado');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Userestado);

		parent::tearDown();
	}

}
