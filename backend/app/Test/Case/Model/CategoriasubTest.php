<?php
App::uses('Categoriasub', 'Model');

/**
 * Categoriasub Test Case
 *
 */
class CategoriasubTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.categoriasub',
		'app.categoria',
		'app.categoriasubbuscar',
		'app.mycarservicio'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Categoriasub = ClassRegistry::init('Categoriasub');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Categoriasub);

		parent::tearDown();
	}

}
