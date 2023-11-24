<?php
App::uses('Usuario', 'Model');

/**
 * Usuario Test Case
 *
 */
class UsuarioTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.usuario',
		'app.mycar',
		'app.role',
		'app.rolesmodulo',
		'app.modulo',
		'app.user',
		'app.estatus',
		'app.empresa',
		'app.empresasurcusale',
		'app.usermodulo',
		'app.busqueda',
		'app.historialpushusuario',
		'app.mycarcalificacione',
		'app.mycarclientehistoriale',
		'app.mycarcliente',
		'app.mycars_valoracion_total',
		'app.mycarsfavorito',
		'app.mycarstipcalificacione',
		'app.publicacione',
		'app.publicaciones_like',
		'app.publicacioneslike',
		'app.sugerencia',
		'app.valoracione'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Usuario = ClassRegistry::init('Usuario');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Usuario);

		parent::tearDown();
	}

}
