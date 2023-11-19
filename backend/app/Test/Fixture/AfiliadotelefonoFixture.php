<?php
/**
 * AfiliadotelefonoFixture
 *
 */
class AfiliadotelefonoFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'biginteger', 'null' => false, 'default' => null, 'unsigned' => true, 'key' => 'primary'),
		'afiliado_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'tipotelefono_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'extencion' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 100, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'telefono' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 100, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
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
			'afiliado_id' => 1,
			'tipotelefono_id' => 1,
			'extencion' => 'Lorem ipsum dolor sit amet',
			'telefono' => 'Lorem ipsum dolor sit amet',
			'created' => '2016-10-31 16:30:05',
			'modified' => '2016-10-31 16:30:05'
		),
	);

}
