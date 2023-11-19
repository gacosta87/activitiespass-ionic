<?php
/**
 * CuestionarioFixture
 *
 */
class CuestionarioFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'biginteger', 'null' => false, 'default' => null, 'unsigned' => true, 'key' => 'primary'),
		'titulo' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 500, 'collate' => 'utf8mb4_general_ci', 'charset' => 'utf8mb4'),
		'beautypoint' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'fecha_inicio' => array('type' => 'date', 'null' => false, 'default' => null),
		'fecha_fin' => array('type' => 'date', 'null' => false, 'default' => null),
		'imagen' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 400, 'collate' => 'utf8mb4_general_ci', 'charset' => 'utf8mb4'),
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
			'titulo' => 'Lorem ipsum dolor sit amet',
			'beautypoint' => 1,
			'fecha_inicio' => '2019-02-12',
			'fecha_fin' => '2019-02-12',
			'imagen' => 'Lorem ipsum dolor sit amet',
			'activo' => 1,
			'created' => '2019-02-12 22:49:06',
			'modified' => '2019-02-12 22:49:06'
		),
	);

}
