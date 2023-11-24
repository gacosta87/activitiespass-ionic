<?php
App::uses('Proyectotipo', 'Model');

/**
 * Proyectotipo Test Case
 *
 */
class ProyectotipoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.proyectotipo',
		'app.proyecto'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Proyectotipo = ClassRegistry::init('Proyectotipo');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Proyectotipo);

		parent::tearDown();
	}

}
