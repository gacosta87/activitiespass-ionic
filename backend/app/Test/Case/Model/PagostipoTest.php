<?php
App::uses('Pagostipo', 'Model');

/**
 * Pagostipo Test Case
 *
 */
class PagostipoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.pagostipo',
		'app.pago'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Pagostipo = ClassRegistry::init('Pagostipo');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Pagostipo);

		parent::tearDown();
	}

}
