<?php
App::uses('Mycar', 'Model');

/**
 * Mycar Test Case
 *
 */
class MycarTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.mycar',
		'app.usuario',
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
		'app.valoracione',
		'app.mycartipo',
		'app.mycarservicio',
		'app.mycartag',
		'app.mycartagsbusqueda'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Mycar = ClassRegistry::init('Mycar');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Mycar);

		parent::tearDown();
	}

}
