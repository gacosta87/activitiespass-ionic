<?php
App::uses('Certificado', 'Model');

/**
 * Certificado Test Case
 *
 */
class CertificadoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.certificado',
		'app.tipocertificado',
		'app.estatus'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Certificado = ClassRegistry::init('Certificado');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Certificado);

		parent::tearDown();
	}

}
