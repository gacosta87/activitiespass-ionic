<?php
App::uses('Mycarstip', 'Model');

/**
 * Mycarstip Test Case
 *
 */
class MycarstipTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.mycarstip',
		'app.mycarstipcalificacione'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Mycarstip = ClassRegistry::init('Mycarstip');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Mycarstip);

		parent::tearDown();
	}

}
