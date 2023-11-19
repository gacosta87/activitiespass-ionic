<?php
App::uses('Notificacionesmj', 'Model');

/**
 * Notificacionesmj Test Case
 *
 */
class NotificacionesmjTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.notificacionesmj'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Notificacionesmj = ClassRegistry::init('Notificacionesmj');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Notificacionesmj);

		parent::tearDown();
	}

}
