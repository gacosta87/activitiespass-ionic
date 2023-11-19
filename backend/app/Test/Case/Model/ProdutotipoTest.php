<?php
App::uses('Produtotipo', 'Model');

/**
 * Produtotipo Test Case
 *
 */
class ProdutotipoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.produtotipo'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Produtotipo = ClassRegistry::init('Produtotipo');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Produtotipo);

		parent::tearDown();
	}

}
