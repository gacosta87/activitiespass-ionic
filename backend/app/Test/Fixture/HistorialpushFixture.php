<?php
/**
 * HistorialpushFixture
 *
 */
class HistorialpushFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'historialpush';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'biginteger', 'null' => false, 'default' => null, 'unsigned' => true, 'key' => 'primary'),
		'titulo' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 100, 'collate' => 'utf8mb4_general_ci', 'charset' => 'utf8mb4'),
		'texto' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 300, 'collate' => 'utf8mb4_general_ci', 'charset' => 'utf8mb4'),
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
			'titulo' => 'Lorem ipsum dolor sit amet',
			'texto' => 'Lorem ipsum dolor sit amet',
			'activo' => 1,
			'created' => '2020-03-27 23:13:32',
			'modified' => '2020-03-27 23:13:32'
		),
	);

}
