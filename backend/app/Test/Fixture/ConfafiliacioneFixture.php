<?php
/**
 * ConfafiliacioneFixture
 *
 */
class ConfafiliacioneFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'biginteger', 'null' => false, 'default' => null, 'unsigned' => true, 'key' => 'primary'),
		'mesesadicionales' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'tarjetasadicionales' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'montodocumentacion' => array('type' => 'float', 'null' => false, 'default' => null, 'length' => '26,2', 'unsigned' => false),
		'montoreserva' => array('type' => 'float', 'null' => false, 'default' => null, 'length' => '26,2', 'unsigned' => false),
		'tasadecambio' => array('type' => 'float', 'null' => false, 'default' => null, 'length' => '26,2', 'unsigned' => false),
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
			'mesesadicionales' => 1,
			'tarjetasadicionales' => 1,
			'montodocumentacion' => 1,
			'montoreserva' => 1,
			'tasadecambio' => 1,
			'created' => '2016-10-20 10:16:12',
			'modified' => '2016-10-20 10:16:12'
		),
	);

}
