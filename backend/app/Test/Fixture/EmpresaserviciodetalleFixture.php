<?php
/**
 * EmpresaserviciodetalleFixture
 *
 */
class EmpresaserviciodetalleFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'biginteger', 'null' => false, 'default' => null, 'unsigned' => true, 'key' => 'primary'),
		'empresaservicio_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'tiposervicio_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
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
			'empresaservicio_id' => 1,
			'tiposervicio_id' => 1,
			'created' => '2018-11-09 08:01:00',
			'modified' => '2018-11-09 08:01:00'
		),
	);

}
