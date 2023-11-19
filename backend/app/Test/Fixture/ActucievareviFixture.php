<?php
/**
 * ActucievareviFixture
 *
 */
class ActucievareviFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'biginteger', 'null' => false, 'default' => null, 'unsigned' => true, 'key' => 'primary'),
		'actucieva_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'organigrama1_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'organigrama2_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'organigrama3_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'organigrama4_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'organigrama5_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'organigrama6_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'organigrama7_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'organigrama8_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'organigrama9_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'organigrama10_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'createed' => array('type' => 'datetime', 'null' => false, 'default' => null),
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
			'actucieva_id' => 1,
			'organigrama1_id' => 1,
			'organigrama2_id' => 1,
			'organigrama3_id' => 1,
			'organigrama4_id' => 1,
			'organigrama5_id' => 1,
			'organigrama6_id' => 1,
			'organigrama7_id' => 1,
			'organigrama8_id' => 1,
			'organigrama9_id' => 1,
			'organigrama10_id' => 1,
			'createed' => '2017-06-17 21:04:35',
			'modified' => '2017-06-17 21:04:35'
		),
	);

}
