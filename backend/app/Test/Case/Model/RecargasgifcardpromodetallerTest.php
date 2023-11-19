<?php
App::uses('Recargasgifcardpromodetaller', 'Model');

/**
 * Recargasgifcardpromodetaller Test Case
 *
 */
class RecargasgifcardpromodetallerTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.recargasgifcardpromodetaller',
		'app.recargasgifcardpromo',
		'app.recargasgifcardpromousuario',
		'app.user',
		'app.role',
		'app.rolesmodulo',
		'app.modulo',
		'app.estatus',
		'app.empresa',
		'app.empresatipo',
		'app.afiliacion',
		'app.empresasurcusale',
		'app.usermodulo',
		'app.tiposervicio',
		'app.listadouserservicio'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Recargasgifcardpromodetaller = ClassRegistry::init('Recargasgifcardpromodetaller');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Recargasgifcardpromodetaller);

		parent::tearDown();
	}

}
