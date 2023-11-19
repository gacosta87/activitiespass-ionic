<?php
App::uses('Recargasgifcardpromousuario', 'Model');

/**
 * Recargasgifcardpromousuario Test Case
 *
 */
class RecargasgifcardpromousuarioTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.recargasgifcardpromousuario',
		'app.recargasgifcardpromo',
		'app.recargasgifcardpromodetaller',
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
		$this->Recargasgifcardpromousuario = ClassRegistry::init('Recargasgifcardpromousuario');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Recargasgifcardpromousuario);

		parent::tearDown();
	}

}
