<?php
/**
 * EmpresahorarioFixture
 *
 */
class EmpresahorarioFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'biginteger', 'null' => false, 'default' => null, 'unsigned' => true, 'key' => 'primary'),
		'empresa_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'puesto' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'hora' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
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
			'puesto' => 1,
			'hora' => 1,
			'activo' => 1,
			'created' => '2019-03-23 16:36:14',
			'modified' => '2019-03-23 16:36:14'
		),
	);

}
