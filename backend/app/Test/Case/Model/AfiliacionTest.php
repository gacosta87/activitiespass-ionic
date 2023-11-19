<?php
App::uses('Afiliacion', 'Model');

/**
 * Afiliacion Test Case
 *
 */
class AfiliacionTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.afiliacion'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Afiliacion = ClassRegistry::init('Afiliacion');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Afiliacion);

		parent::tearDown();
	}

}
