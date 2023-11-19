<?php
App::uses('Mycartag', 'Model');

/**
 * Mycartag Test Case
 *
 */
class MycartagTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.mycartag',
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
		$this->Mycartag = ClassRegistry::init('Mycartag');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Mycartag);

		parent::tearDown();
	}

}
