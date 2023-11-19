<?php
/**
 * AfiliadostarjetaFixture
 *
 */
class AfiliadostarjetaFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'biginteger', 'null' => false, 'default' => null, 'unsigned' => true, 'key' => 'primary'),
		'afiliado_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'banco_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'tarjta_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'numero_tarjeta' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 100, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'expira' => array('type' => 'date', 'null' => false, 'default' => null),
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
			'afiliado_id' => 1,
			'banco_id' => 1,
			'tarjta_id' => 1,
			'numero_tarjeta' => 'Lorem ipsum dolor sit amet',
			'expira' => '2016-10-31',
			'created' => '2016-10-31 16:29:44',
			'modified' => '2016-10-31 16:29:44'
		),
	);

}
