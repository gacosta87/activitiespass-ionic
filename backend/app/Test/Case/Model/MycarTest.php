<?php
App::uses('Mycar', 'Model');

/**
 * Mycar Test Case
 *
 */
class MycarTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.mycar',
		'app.mycartipo',
		'app.mycarcalificacione',
		'app.usuario',
		'app.role',
		'app.historialpushusuario',
		'app.mycarservicio'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Mycar = ClassRegistry::init('Mycar');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Mycar);

		parent::tearDown();
	}

}
