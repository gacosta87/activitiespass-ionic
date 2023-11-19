<?php
App::uses('Abogadosmensaje', 'Model');

/**
 * Abogadosmensaje Test Case
 *
 */
class AbogadosmensajeTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.abogadosmensaje',
		'app.user',
		'app.role',
		'app.rolesmodulo',
		'app.modulo',
		'app.estatus',
		'app.empresa',
		'app.empresasurcusale',
		'app.abogado',
		'app.usermodulo'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Abogadosmensaje = ClassRegistry::init('Abogadosmensaje');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Abogadosmensaje);

		parent::tearDown();
	}

}
