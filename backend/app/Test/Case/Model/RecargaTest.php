<?php
App::uses('Recarga', 'Model');

/**
 * Recarga Test Case
 *
 */
class RecargaTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.recarga',
		'app.empresa',
		'app.empresatipo',
		'app.afiliacion',
		'app.empresasurcusale',
		'app.user',
		'app.role',
		'app.rolesmodulo',
		'app.modulo',
		'app.estatus',
		'app.usermodulo',
		'app.tiporecarga'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Recarga = ClassRegistry::init('Recarga');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Recarga);

		parent::tearDown();
	}

}
