<?php
App::uses('Notificacionesmjsusuario', 'Model');

/**
 * Notificacionesmjsusuario Test Case
 *
 */
class NotificacionesmjsusuarioTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.notificacionesmjsusuario',
		'app.user',
		'app.role',
		'app.rolesmodulo',
		'app.modulo',
		'app.estatus',
		'app.empresa',
		'app.empresatipo',
		'app.afiliacion',
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
		$this->Notificacionesmjsusuario = ClassRegistry::init('Notificacionesmjsusuario');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Notificacionesmjsusuario);

		parent::tearDown();
	}

}
