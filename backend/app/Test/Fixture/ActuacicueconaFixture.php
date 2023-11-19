<?php
/**
 * ActuacicueconaFixture
 *
 */
class ActuacicueconaFixture extends CakeTestFixture {

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
		'conductual' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 300, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'valor' => array('type' => 'decimal', 'null' => false, 'default' => null, 'length' => '26,2', 'unsigned' => false),
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
			'conductual' => 'Lorem ipsum dolor sit amet',
			'valor' => '',
			'activo' => 1,
			'created' => '2017-07-01 16:51:23',
			'modified' => '2017-07-01 16:51:23'
		),
	);

}
