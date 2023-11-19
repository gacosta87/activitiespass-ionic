<?php
App::uses('Mycarscomentario', 'Model');

/**
 * Mycarscomentario Test Case
 *
 */
class MycarscomentarioTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.mycarscomentario',
		'app.publicacione',
		'app.mycar',
		'app.mycartipo',
		'app.mycarcalificacione',
		'app.usuario',
		'app.role',
		'app.historialpushusuario',
		'app.mycarservicio',
		'app.categoria',
		'app.categoriasubbuscar',
		'app.categoriasub'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Mycarscomentario = ClassRegistry::init('Mycarscomentario');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Mycarscomentario);

		parent::tearDown();
	}

}
