<?php
App::uses('Denuncia', 'Model');

/**
 * Denuncia Test Case
 *
 */
class DenunciaTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.denuncia',
		'app.usuario',
		'app.mycar',
		'app.mycartipo',
		'app.mycarcalificacione',
		'app.mycarservicio',
		'app.categoria',
		'app.categoriasubbuscar',
		'app.categoriasub',
		'app.role',
		'app.historialpushusuario',
		'app.publicacione',
		'app.mycarscomentario',
		'app.publicacioneslike'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Denuncia = ClassRegistry::init('Denuncia');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Denuncia);

		parent::tearDown();
	}

}
