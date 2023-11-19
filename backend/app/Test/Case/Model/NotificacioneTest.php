<?php
App::uses('Notificacione', 'Model');

/**
 * Notificacione Test Case
 *
 */
class NotificacioneTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.notificacione',
		'app.notificaciontipo'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Notificacione = ClassRegistry::init('Notificacione');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Notificacione);

		parent::tearDown();
	}

}
