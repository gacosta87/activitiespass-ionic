<?php
/**
 * ActuacioncompcargoFixture
 *
 */
class ActuacioncompcargoFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'biginteger', 'null' => false, 'default' => null, 'unsigned' => true, 'key' => 'primary'),
		'empresa_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'actuacioncompetenciatipo_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'actuacioncompetencia_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'nominatipo_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'nominacargo_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
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
			'actuacioncompetenciatipo_id' => 1,
			'actuacioncompetencia_id' => 1,
			'nominatipo_id' => 1,
			'nominacargo_id' => 1,
			'activo' => 1,
			'created' => '2017-06-25 16:09:24',
			'modified' => '2017-06-25 16:09:24'
		),
	);

}
