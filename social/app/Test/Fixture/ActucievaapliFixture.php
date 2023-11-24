<?php
/**
 * ActucievaapliFixture
 *
 */
class ActucievaapliFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'biginteger', 'null' => false, 'default' => null, 'unsigned' => true, 'key' => 'primary'),
		'actucievas_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'nominatipo_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'nominacargo_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'indexes' => array(
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
			'actucievas_id' => 1,
			'nominatipo_id' => 1,
			'nominacargo_id' => 1,
			'created' => '2017-06-17 21:03:58',
			'modified' => '2017-06-17 21:03:58'
		),
	);

}
