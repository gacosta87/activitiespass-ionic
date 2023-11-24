<?php
/**
 * ResactuacicuefunbFixture
 *
 */
class ResactuacicuefunbFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'biginteger', 'null' => false, 'default' => null, 'unsigned' => true, 'key' => 'primary'),
		'resactuacicuefuna_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'denominacion' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 300, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'verdadero' => array('type' => 'integer', 'null' => false, 'default' => '1', 'unsigned' => false),
		'respuesta' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'id' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => '',
			'resactuacicuefuna_id' => 1,
			'denominacion' => 'Lorem ipsum dolor sit amet',
			'verdadero' => 1,
			'respuesta' => 1,
			'created' => '2017-07-07 13:53:57',
			'modified' => '2017-07-07 13:53:57'
		),
	);

}
