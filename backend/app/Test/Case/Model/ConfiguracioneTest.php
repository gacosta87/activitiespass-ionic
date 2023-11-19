<?php
App::uses('Configuracione', 'Model');

/**
 * Configuracione Test Case
 *
 */
class ConfiguracioneTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.configuracione'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Configuracione = ClassRegistry::init('Configuracione');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Configuracione);

		parent::tearDown();
	}

}
