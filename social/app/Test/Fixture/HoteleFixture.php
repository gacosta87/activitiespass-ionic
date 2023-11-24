<?php
/**
 * HoteleFixture
 *
 */
class HoteleFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'biginteger', 'null' => false, 'default' => null, 'unsigned' => true, 'key' => 'primary'),
		'nombrehotel' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 200, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'moneda_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'simple' => array('type' => 'float', 'null' => false, 'default' => null, 'length' => '26,2', 'unsigned' => false),
		'doble' => array('type' => 'float', 'null' => false, 'default' => null, 'length' => '26,2', 'unsigned' => false),
		'triple' => array('type' => 'float', 'null' => false, 'default' => null, 'length' => '26,2', 'unsigned' => false),
		'cuadruple' => array('type' => 'float', 'null' => false, 'default' => null, 'length' => '26,2', 'unsigned' => false),
		'nino' => array('type' => 'float', 'null' => false, 'default' => null, 'length' => '26,2', 'unsigned' => false),
		'ninogratis' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'validodesde' => array('type' => 'date', 'null' => false, 'default' => null),
		'valiohasta' => array('type' => 'date', 'null' => false, 'default' => null),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'modifed' => array('type' => 'datetime', 'null' => false, 'default' => null),
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
			'nombrehotel' => 'Lorem ipsum dolor sit amet',
			'moneda_id' => 1,
			'simple' => 1,
			'doble' => 1,
			'triple' => 1,
			'cuadruple' => 1,
			'nino' => 1,
			'ninogratis' => 1,
			'validodesde' => '2016-10-21',
			'valiohasta' => '2016-10-21',
			'created' => '2016-10-21 21:31:44',
			'modifed' => '2016-10-21 21:31:44'
		),
	);

}
