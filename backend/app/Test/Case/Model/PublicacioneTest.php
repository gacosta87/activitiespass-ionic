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
		'app.mycarcalificacione',
		'app.mycarservicio',
		'app.categoria',
		'app.categoriasubbuscar',
		'app.categoriasub',
		'app.role',
		'app.historialpushusuario',
		'app.denuncia',
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
