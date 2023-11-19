<?php
App::uses('Publicidade', 'Model');

/**
 * Publicidade Test Case
 *
 */
class PublicidadeTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.publicidade'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Publicidade = ClassRegistry::init('Publicidade');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Publicidade);

		parent::tearDown();
	}

}
