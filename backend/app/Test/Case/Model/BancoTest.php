<?php
App::uses('Banco', 'Model');

/**
 * Banco Test Case
 *
 */
class BancoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.banco'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Banco = ClassRegistry::init('Banco');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Banco);

		parent::tearDown();
	}

}
