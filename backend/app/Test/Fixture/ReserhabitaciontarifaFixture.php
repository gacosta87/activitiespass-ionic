<?php
/**
 * ReserhabitaciontarifaFixture
 *
 */
class ReserhabitaciontarifaFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'Reserhabitaciontarifas';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'biginteger', 'null' => false, 'default' => null, 'unsigned' => true, 'key' => 'primary'),
		'reserhabitaciontipo_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'reserhabitacione_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'monto' => array('type' => 'float', 'null' => false, 'default' => null, 'length' => '26,2', 'unsigned' => false),
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
			'reserhabitaciontipo_id' => 1,
			'reserhabitacione_id' => 1,
			'monto' => 1,
			'created' => '2016-12-12 23:11:45',
			'modified' => '2016-12-12 23:11:45'
		),
	);

}
