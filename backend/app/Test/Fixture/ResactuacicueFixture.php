<?php
/**
 * ResactuacicueFixture
 *
 */
class ResactuacicueFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'biginteger', 'null' => false, 'default' => null, 'unsigned' => true, 'key' => 'primary'),
		'empresa_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'actucieva_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'nominatipo_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'nominacargo_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'nominaficha_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'denominacion' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 300, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'fecha' => array('type' => 'date', 'null' => false, 'default' => null),
		'funcional' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'conceptual' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'objetivos' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'funcion_valor' => array('type' => 'decimal', 'null' => false, 'default' => null, 'length' => '26,2', 'unsigned' => false),
		'conceptual_valor' => array('type' => 'decimal', 'null' => false, 'default' => null, 'length' => '26,2', 'unsigned' => false),
		'objetivos_valor' => array('type' => 'decimal', 'null' => false, 'default' => null, 'length' => '26,2', 'unsigned' => false),
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
			'actucieva_id' => 1,
			'nominatipo_id' => 1,
			'nominacargo_id' => 1,
			'nominaficha_id' => 1,
			'denominacion' => 'Lorem ipsum dolor sit amet',
			'fecha' => '2017-07-07',
			'funcional' => 1,
			'conceptual' => 1,
			'objetivos' => 1,
			'funcion_valor' => '',
			'conceptual_valor' => '',
			'objetivos_valor' => '',
			'activo' => 1,
			'created' => '2017-07-07 14:57:38',
			'modified' => '2017-07-07 14:57:38'
		),
	);

}
