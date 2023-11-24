<?php
App::uses('Publicacione', 'Model');

/**
 * Publicacione Test Case
 *
 */
class PublicacioneTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.publicacione',
		'app.usuario',
		'app.mycar',
		'app.mycartipo',
		'app.role',
		'app.rolesmodulo',
		'app.modulo',
		'app.user',
		'app.estatus',
		'app.empresa',
		'app.empresasurcusale',
		'app.usermodulo',
		'app.mycarcalificacione',
		'app.mycarclientehistoriale',
		'app.mycarcliente',
		'app.mycarservicio',
		'app.mycarsfavorito',
		'app.mycartag',
		'app.mycartagsbusqueda',
		'app.publicaciones_like',
		'app.publicacioneslike',
		'app.valoracione',
		'app.busqueda',
		'app.historialpushusuario',
		'app.mycars_valoracion_total',
		'app.mycarstipcalificacione',
		'app.sugerencia'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Publicacione = ClassRegistry::init('Publicacione');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Publicacione);

		parent::tearDown();
	}

}
