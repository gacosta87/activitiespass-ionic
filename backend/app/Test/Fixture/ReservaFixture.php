<?php
/**
 * ReservaFixture
 *
 */
class ReservaFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'biginteger', 'null' => false, 'default' => null, 'unsigned' => true, 'key' => 'primary'),
		'empresa_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'confirmado' => array('type' => 'integer', 'null' => false, 'default' => '1', 'unsigned' => false),
		'hora' => array('type' => 'time', 'null' => false, 'default' => null),
		'fecha' => array('type' => 'date', 'null' => false, 'default' => null),
		'activo' => array('type' => 'integer', 'null' => false, 'default' => '1', 'unsigned' => false),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => null),
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
			'empresa_id' => 1,
			'user_id' => 1,
			'confirmado' => 1,
			'hora' => '10:45:50',
			'fecha' => '2018-11-12',
			'activo' => 1,
			'created' => '2018-11-12 10:45:50',
			'modified' => '2018-11-12 10:45:50'
		),
	);

}
