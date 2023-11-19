<?php
/**
 * ReserhabitacioneFixture
 *
 */
class ReserhabitacioneFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'Reserhabitaciones';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'biginteger', 'null' => false, 'default' => null, 'unsigned' => true, 'key' => 'primary'),
		'reserhabitaciontipo_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'reserhabitacionstatu_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'numhabitacion' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'descripcion' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 300, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'capacidad' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
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
			'reserhabitaciontipo_id' => 1,
			'reserhabitacionstatu_id' => 1,
			'numhabitacion' => 1,
			'descripcion' => 'Lorem ipsum dolor sit amet',
			'capacidad' => 1,
			'created' => '2016-12-12 22:35:31',
			'modified' => '2016-12-12 22:35:31'
		),
	);

}
