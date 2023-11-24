<?php
App::uses('Asistentechatsrede', 'Model');

/**
 * Asistentechatsrede Test Case
 *
 */
class AsistentechatsredeTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.asistentechatsrede',
		'app.sender',
		'app.recipient',
		'app.mensaje',
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
		'app.paraticategoria',
		'app.paratidetalle'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Asistentechatsrede = ClassRegistry::init('Asistentechatsrede');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Asistentechatsrede);

		parent::tearDown();
	}

}
