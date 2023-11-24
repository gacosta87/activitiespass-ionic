<?php
/**
 * NominapersonaleFixture
 *
 */
class NominapersonaleFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'nombre_apellido' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 500, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'fecha_nacimiento' => array('type' => 'date', 'null' => false, 'default' => null),
		'direpai_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'direprovincia_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'dirmunicipio_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'fecha_contrato' => array('type' => 'date', 'null' => false, 'default' => null),
		'telefono' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 300, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'email' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 300, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'facebook' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 300, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'twitter' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 300, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'activo' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
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
			'id' => 1,
			'nombre_apellido' => 'Lorem ipsum dolor sit amet',
			'fecha_nacimiento' => '2017-04-21',
			'direpai_id' => 1,
			'direprovincia_id' => 1,
			'dirmunicipio_id' => 1,
			'fecha_contrato' => '2017-04-21',
			'telefono' => 'Lorem ipsum dolor sit amet',
			'email' => 'Lorem ipsum dolor sit amet',
			'facebook' => 'Lorem ipsum dolor sit amet',
			'twitter' => 'Lorem ipsum dolor sit amet',
			'activo' => 1,
			'created' => '2017-04-21 11:05:32',
			'modified' => '2017-04-21 11:05:32'
		),
	);

}
