<?php
App::uses('Mycarsfavorito', 'Model');

/**
 * Mycarsfavorito Test Case
 *
 */
class MycarsfavoritoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.mycarsfavorito',
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
		$this->Mycarsfavorito = ClassRegistry::init('Mycarsfavorito');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Mycarsfavorito);

		parent::tearDown();
	}

}
