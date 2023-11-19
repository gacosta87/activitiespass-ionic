<?php
App::uses('Casetraking', 'Model');

/**
 * Casetraking Test Case
 *
 */
class CasetrakingTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.casetraking'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Casetraking = ClassRegistry::init('Casetraking');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Casetraking);

		parent::tearDown();
	}

}
