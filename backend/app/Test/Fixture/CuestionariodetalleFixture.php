<?php
/**
 * CuestionariodetalleFixture
 *
 */
class CuestionariodetalleFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'biginteger', 'null' => false, 'default' => null, 'unsigned' => true, 'key' => 'primary'),
		'cuestionario_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'cuestionariopregunta_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'opcion' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 500, 'collate' => 'utf8mb4_general_ci', 'charset' => 'utf8mb4'),
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
			'cuestionario_id' => 1,
			'cuestionariopregunta_id' => 1,
			'opcion' => 'Lorem ipsum dolor sit amet',
			'activo' => 1,
			'created' => '2019-02-12 22:49:35',
			'modified' => '2019-02-12 22:49:35'
		),
	);

}
