<?php
App::uses('Notificaciontipo', 'Model');

/**
 * Notificaciontipo Test Case
 *
 */
class NotificaciontipoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.notificaciontipo',
		'app.notificacione'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Notificaciontipo = ClassRegistry::init('Notificaciontipo');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Notificaciontipo);

		parent::tearDown();
	}

}
