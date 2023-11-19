<?php
App::uses('Afiliadostaradicionle', 'Model');

/**
 * Afiliadostaradicionle Test Case
 *
 */
class AfiliadostaradicionleTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.afiliadostaradicionle'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Afiliadostaradicionle = ClassRegistry::init('Afiliadostaradicionle');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Afiliadostaradicionle);

		parent::tearDown();
	}

}
