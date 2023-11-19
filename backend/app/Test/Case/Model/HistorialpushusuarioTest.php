<?php
App::uses('Historialpushusuario', 'Model');

/**
 * Historialpushusuario Test Case
 *
 */
class HistorialpushusuarioTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.historialpushusuario',
		'app.usuario',
		'app.mycar',
		'app.role',
		'app.mycarcalificacione'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Historialpushusuario = ClassRegistry::init('Historialpushusuario');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Historialpushusuario);

		parent::tearDown();
	}

}
