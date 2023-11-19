<?php
App::uses('Tipocabello', 'Model');

/**
 * Tipocabello Test Case
 *
 */
class TipocabelloTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.tipocabello'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Tipocabello = ClassRegistry::init('Tipocabello');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Tipocabello);

		parent::tearDown();
	}

}
