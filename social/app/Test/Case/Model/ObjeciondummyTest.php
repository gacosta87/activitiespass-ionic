<?php
App::uses('Objeciondummy', 'Model');

/**
 * Objeciondummy Test Case
 *
 */
class ObjeciondummyTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.objeciondummy',
		'app.colore'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Objeciondummy = ClassRegistry::init('Objeciondummy');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Objeciondummy);

		parent::tearDown();
	}

}
