<?php
/**
 * ResactuacicuefunaFixture
 *
 */
class ResactuacicuefunaFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'biginteger', 'null' => false, 'default' => null, 'unsigned' => true, 'key' => 'primary'),
		'empresa_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'actucieva_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'actuacicue_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'actuacioncompetenciatipo_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'actuacioncompetencia_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'nominatipo_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'nominacargo_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'nominaficha_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'realizada' => array('type' => 'integer', 'null' => false, 'default' => '1', 'unsigned' => false),
		'funcional' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 300, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'valor' => array('type' => 'decimal', 'null' => false, 'default' => null, 'length' => '26,2', 'unsigned' => false),
		'respuesta' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'segundos' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'tipo' => array('type' => 'integer', 'null' => false, 'default' => '1', 'unsigned' => false),
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
			'actuacicue_id' => 1,
			'actuacioncompetenciatipo_id' => 1,
			'actuacioncompetencia_id' => 1,
			'nominatipo_id' => 1,
			'nominacargo_id' => 1,
			'nominaficha_id' => 1,
			'realizada' => 1,
			'funcional' => 'Lorem ipsum dolor sit amet',
			'valor' => '',
			'respuesta' => 1,
			'segundos' => 1,
			'tipo' => 1,
			'activo' => 1,
			'created' => '2017-07-07 13:53:47',
			'modified' => '2017-07-07 13:53:47'
		),
	);

}
