<?php
/**
 * OrganizateFixture
 *
 */
class OrganizateFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'organizate';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'biginteger', 'null' => false, 'default' => null, 'unsigned' => true, 'key' => 'primary'),
		'tipo' => array('type' => 'integer', 'null' => false, 'default' => '1', 'unsigned' => false, 'comment' => '1) ingreso 2) egreso'),
		'detalles' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 300, 'collate' => 'utf8mb4_general_ci', 'charset' => 'utf8mb4'),
		'monto' => array('type' => 'float', 'null' => false, 'default' => null, 'length' => '26,2', 'unsigned' => false),
		'activo' => array('type' => 'integer', 'null' => false, 'default' => '1', 'unsigned' => false),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'indexes' => array(
			'id' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8mb4', 'collate' => 'utf8mb4_general_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => '',
			'tipo' => 1,
			'detalles' => 'Lorem ipsum dolor sit amet',
			'monto' => 1,
			'activo' => 1,
			'created' => '2019-09-18 16:57:38',
			'modified' => '2019-09-18 16:57:38'
		),
	);

}
