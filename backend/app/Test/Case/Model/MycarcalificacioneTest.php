<?php
App::uses('Mycarcalificacione', 'Model');

/**
 * Mycarcalificacione Test Case
 *
 */
class MycarcalificacioneTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.mycarcalificacione',
		'app.mycar',
		'app.usuario',
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
		$this->Mycarcalificacione = ClassRegistry::init('Mycarcalificacione');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Mycarcalificacione);

		parent::tearDown();
	}

}
