<?php
App::uses('Prospectolote', 'Model');

/**
 * Prospectolote Test Case
 *
 */
class ProspectoloteTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.prospectolote',
		'app.estatu',
		'app.prospecto'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Prospectolote = ClassRegistry::init('Prospectolote');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Prospectolote);

		parent::tearDown();
	}

}
