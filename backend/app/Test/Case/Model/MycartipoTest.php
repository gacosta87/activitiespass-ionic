<?php
App::uses('Mycartipo', 'Model');

/**
 * Mycartipo Test Case
 *
 */
class MycartipoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.mycartipo',
		'app.mycar',
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
		$this->Mycartipo = ClassRegistry::init('Mycartipo');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Mycartipo);

		parent::tearDown();
	}

}
