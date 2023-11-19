<?php
/**
 * CategoriasubbuscarFixture
 *
 */
class CategoriasubbuscarFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'biginteger', 'null' => false, 'default' => null, 'unsigned' => true, 'key' => 'primary'),
		'categoria_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'categoriasub_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'palabra' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8mb4_general_ci', 'charset' => 'utf8mb4'),
		'activo' => array('type' => 'integer', 'null' => false, 'default' => '1', 'unsigned' => false),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'indexes' => array(
			
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
			'categoria_id' => 1,
			'categoriasub_id' => 1,
			'palabra' => 'Lorem ipsum dolor sit amet',
			'activo' => 1,
			'created' => '2020-03-27 23:13:11',
			'modified' => '2020-03-27 23:13:11'
		),
	);

}
