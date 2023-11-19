<?php
App::uses('Calificaciontipo', 'Model');

/**
 * Calificaciontipo Test Case
 *
 */
class CalificaciontipoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.calificaciontipo',
		'app.calificacione'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Calificaciontipo = ClassRegistry::init('Calificaciontipo');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Calificaciontipo);

		parent::tearDown();
	}

}
