<?php
/**
 * ResactuacicueconbFixture
 *
 */
class ResactuacicueconbFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'biginteger', 'null' => false, 'default' => null, 'unsigned' => true, 'key' => 'primary'),
		'resactuacicuecona_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'actucicali_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'valor' => array('type' => 'decimal', 'null' => false, 'default' => null, 'length' => '26,2', 'unsigned' => false),
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
			'resactuacicuecona_id' => 1,
			'actucicali_id' => 1,
			'valor' => '',
			'respuesta' => 1,
			'created' => '2017-07-07 13:53:32',
			'modified' => '2017-07-07 13:53:32'
		),
	);

}
