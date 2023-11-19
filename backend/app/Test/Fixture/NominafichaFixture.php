<?php
/**
 * NominafichaFixture
 *
 */
class NominafichaFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'biginteger', 'null' => false, 'default' => null, 'unsigned' => true, 'key' => 'primary'),
		'empresa_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'empresasurcusale_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'nominatipo_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'nominacargo_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'nominapersonale_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'cod_ficha' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'fecha_alta' => array('type' => 'date', 'null' => false, 'default' => null),
		'nominastatu_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'activo' => array('type' => 'integer', 'null' => false, 'default' => '1', 'unsigned' => false),
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
			'empresa_id' => 1,
			'empresasurcusale_id' => 1,
			'nominatipo_id' => 1,
			'nominacargo_id' => 1,
			'nominapersonale_id' => 1,
			'cod_ficha' => 1,
			'fecha_alta' => '2017-06-11',
			'nominastatu_id' => 1,
			'activo' => 1,
			'created' => '2017-06-11 12:14:02',
			'modified' => '2017-06-11 12:14:02'
		),
	);

}
