<?php
App::uses('Mycarservicio', 'Model');

/**
 * Mycarservicio Test Case
 *
 */
class MycarservicioTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.mycarservicio',
		'app.mycar',
		'app.mycartipo',
		'app.mycarcalificacione',
		'app.usuario',
		'app.role',
		'app.historialpushusuario',
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
		$this->Mycarservicio = ClassRegistry::init('Mycarservicio');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Mycarservicio);

		parent::tearDown();
	}

}
