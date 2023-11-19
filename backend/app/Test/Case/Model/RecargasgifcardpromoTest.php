<?php
App::uses('Recargasgifcardpromo', 'Model');

/**
 * Recargasgifcardpromo Test Case
 *
 */
class RecargasgifcardpromoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.recargasgifcardpromo',
		'app.recargasgifcardpromodetaller',
		'app.recargasgifcardpromousuario'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Recargasgifcardpromo = ClassRegistry::init('Recargasgifcardpromo');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Recargasgifcardpromo);

		parent::tearDown();
	}

}
