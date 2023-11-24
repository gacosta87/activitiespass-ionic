<?php
/**
 * ReservacionespagofacturaFixture
 *
 */
class ReservacionespagofacturaFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'reservacionespagofactura';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'biginteger', 'null' => false, 'default' => null, 'unsigned' => true, 'key' => 'primary'),
		'reservacione_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'nfactura' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 100, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
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
			'reservacione_id' => 1,
			'nfactura' => 'Lorem ipsum dolor sit amet'
		),
	);

}
