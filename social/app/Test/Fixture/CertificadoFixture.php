<?php
/**
 * CertificadoFixture
 *
 */
class CertificadoFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'biginteger', 'null' => false, 'default' => null, 'unsigned' => true, 'key' => 'primary'),
		'nombre' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'tipocertificado_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'descuento' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'cantidad' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'estatus_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'id' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => '',
			'nombre' => 1,
			'tipocertificado_id' => 1,
			'descuento' => 1,
			'cantidad' => 1,
			'estatus_id' => 1,
			'created' => '2016-10-21 21:05:14',
			'modified' => '2016-10-21 21:05:14'
		),
	);

}
