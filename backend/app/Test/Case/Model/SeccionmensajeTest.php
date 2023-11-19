<?php
App::uses('Seccionmensaje', 'Model');

/**
 * Seccionmensaje Test Case
 *
 */
class SeccionmensajeTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.seccionmensaje',
		'app.user',
		'app.role',
		'app.rolesmodulo',
		'app.modulo',
		'app.estatus',
		'app.empresa',
		'app.empresasurcusale',
		'app.usermodulo'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Seccionmensaje = ClassRegistry::init('Seccionmensaje');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Seccionmensaje);

		parent::tearDown();
	}

}
