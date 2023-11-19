<?php
App::uses('Categoriasubbuscar', 'Model');

/**
 * Categoriasubbuscar Test Case
 *
 */
class CategoriasubbuscarTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.categoriasubbuscar',
		'app.categoria',
		'app.categoriasub',
		'app.mycarservicio'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Categoriasubbuscar = ClassRegistry::init('Categoriasubbuscar');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Categoriasubbuscar);

		parent::tearDown();
	}

}
