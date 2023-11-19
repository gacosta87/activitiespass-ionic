<?php
App::uses('Mycarstipcalificacione', 'Model');

/**
 * Mycarstipcalificacione Test Case
 *
 */
class MycarstipcalificacioneTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.mycarstipcalificacione',
		'app.mycarstip',
		'app.usuario',
		'app.mycar',
		'app.mycartipo',
		'app.mycarcalificacione',
		'app.mycarservicio',
		'app.categoria',
		'app.categoriasubbuscar',
		'app.categoriasub',
		'app.role',
		'app.historialpushusuario'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Mycarstipcalificacione = ClassRegistry::init('Mycarstipcalificacione');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Mycarstipcalificacione);

		parent::tearDown();
	}

}
