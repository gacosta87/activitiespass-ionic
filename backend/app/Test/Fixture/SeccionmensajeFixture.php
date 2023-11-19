<?php
/**
 * SeccionmensajeFixture
 *
 */
class SeccionmensajeFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'biginteger', 'null' => false, 'default' => null, 'unsigned' => true, 'key' => 'primary'),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'mensaje' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'leido' => array('type' => 'integer', 'null' => false, 'default' => '1', 'unsigned' => false, 'comment' => '1) no 2) si'),
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
			'user_id' => 1,
			'mensaje' => 1,
			'leido' => 1,
			'activo' => 1,
			'created' => '2018-10-10 17:52:22',
			'modified' => '2018-10-10 17:52:22'
		),
	);

}
