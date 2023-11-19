<?php
App::uses('Scriptdummy', 'Model');

/**
 * Scriptdummy Test Case
 *
 */
class ScriptdummyTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.scriptdummy',
		'app.colore'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Scriptdummy = ClassRegistry::init('Scriptdummy');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Scriptdummy);

		parent::tearDown();
	}

}
