<?php
/**
 * DenunciaFixture
 *
 */
class DenunciaFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'biginteger', 'null' => false, 'default' => null, 'unsigned' => true, 'key' => 'primary'),
		'usuario_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'mycar_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'publicacione_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'activo' => array('type' => 'integer', 'null' => false, 'default' => '1', 'unsigned' => false),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'id' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8mb4', 'collate' => 'utf8mb4_0900_ai_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => '',
			'usuario_id' => 1,
			'mycar_id' => 1,
			'publicacione_id' => 1,
			'activo' => 1,
			'created' => '2020-08-27 22:09:08',
			'modified' => '2020-08-27 22:09:08'
		),
	);

}
