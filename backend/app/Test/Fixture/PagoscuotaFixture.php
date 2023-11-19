<?php
/**
 * PagoscuotaFixture
 *
 */
class PagoscuotaFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'biginteger', 'null' => false, 'default' => null, 'unsigned' => true, 'key' => 'primary'),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'monto' => array('type' => 'float', 'null' => false, 'default' => null, 'length' => '26,2', 'unsigned' => false),
		'cuotas' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'fecha_corte' => array('type' => 'date', 'null' => false, 'default' => null),
		'activo' => array('type' => 'integer', 'null' => false, 'default' => '1', 'unsigned' => false),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'updated_at' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
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
			'user_id' => 1,
			'monto' => 1,
			'cuotas' => 1,
			'fecha_corte' => '2020-01-27',
			'activo' => 1,
			'created' => '2020-01-27 16:04:23',
			'modified' => '2020-01-27 16:04:23',
			'updated_at' => '2020-01-27 16:04:23'
		),
	);

}
