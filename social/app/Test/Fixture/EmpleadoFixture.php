<?php
/**
 * EmpleadoFixture
 *
 */
class EmpleadoFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'biginteger', 'null' => false, 'default' => null, 'unsigned' => true, 'key' => 'primary'),
		'cedula' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 30, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'nombres' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 100, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'apellidos1' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 100, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'apellidos2' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 100, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'cumpleanos' => array('type' => 'date', 'null' => false, 'default' => null),
		'comentarios' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 100, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'estatu_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'sueldo_base' => array('type' => 'float', 'null' => false, 'default' => null, 'length' => '26,2', 'unsigned' => false),
		'membresia' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'reserva' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
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
			'cedula' => 'Lorem ipsum dolor sit amet',
			'nombres' => 'Lorem ipsum dolor sit amet',
			'apellidos1' => 'Lorem ipsum dolor sit amet',
			'apellidos2' => 'Lorem ipsum dolor sit amet',
			'cumpleanos' => '2016-10-21',
			'comentarios' => 'Lorem ipsum dolor sit amet',
			'estatu_id' => 1,
			'sueldo_base' => 1,
			'membresia' => 1,
			'reserva' => 1,
			'created' => '2016-10-21 16:34:08',
			'modified' => '2016-10-21 16:34:08'
		),
	);

}
