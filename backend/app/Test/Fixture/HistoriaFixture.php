<?php
/**
 * HistoriaFixture
 *
 */
class HistoriaFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'biginteger', 'null' => false, 'default' => null, 'unsigned' => true, 'key' => 'primary'),
		'nombre_apellido' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 500, 'collate' => 'utf8mb4_general_ci', 'charset' => 'utf8mb4'),
		'titulo1' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 300, 'collate' => 'utf8mb4_general_ci', 'charset' => 'utf8mb4'),
		'titulo2' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 300, 'collate' => 'utf8mb4_general_ci', 'charset' => 'utf8mb4'),
		'descripcion' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 1000, 'collate' => 'utf8mb4_general_ci', 'charset' => 'utf8mb4'),
		'afiliadas' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'meta' => array('type' => 'integer', 'null' => false, 'default' => '1', 'unsigned' => false, 'comment' => '1) no 2) si'),
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
			'nombre_apellido' => 'Lorem ipsum dolor sit amet',
			'titulo1' => 'Lorem ipsum dolor sit amet',
			'titulo2' => 'Lorem ipsum dolor sit amet',
			'descripcion' => 'Lorem ipsum dolor sit amet',
			'afiliadas' => 1,
			'meta' => 1,
			'activo' => 1,
			'created' => '2018-11-21 23:45:55',
			'modified' => '2018-11-21 23:45:55'
		),
	);

}
