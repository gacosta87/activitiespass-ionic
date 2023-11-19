<?php
/**
 * HoteldummyFixture
 *
 */
class HoteldummyFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'hoteldummys';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'biginteger', 'null' => false, 'default' => null, 'unsigned' => true, 'key' => 'primary'),
		'hotel' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 300, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'provincia_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'colore_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
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
			'hotel' => 'Lorem ipsum dolor sit amet',
			'provincia_id' => 1,
			'colore_id' => 1,
			'created' => '2016-10-24 16:51:46',
			'modified' => '2016-10-24 16:51:46'
		),
	);

}
