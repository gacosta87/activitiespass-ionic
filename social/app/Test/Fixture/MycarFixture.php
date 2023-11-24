<?php
/**
 * MycarFixture
 *
 */
class MycarFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'biginteger', 'null' => false, 'default' => null, 'unsigned' => true, 'key' => 'primary'),
		'usuario_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'rif' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 500, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'razon_social' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 300, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'descripcion' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'representante' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 500, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'mycartipo_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'role_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'orden' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'email' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 200, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'telefono' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'website' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 200, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'direccion' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 300, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'latitud' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 300, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'longitud' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 300, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'foto1' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'thumbnail1' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 1000, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'foto2' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'foto3' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'foto4' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'lunes' => array('type' => 'integer', 'null' => true, 'default' => '1', 'unsigned' => false),
		'martes' => array('type' => 'integer', 'null' => true, 'default' => '1', 'unsigned' => false),
		'miercoles' => array('type' => 'integer', 'null' => true, 'default' => '1', 'unsigned' => false),
		'jueves' => array('type' => 'integer', 'null' => true, 'default' => '1', 'unsigned' => false),
		'viernes' => array('type' => 'integer', 'null' => true, 'default' => '1', 'unsigned' => false),
		'sabado' => array('type' => 'integer', 'null' => true, 'default' => '1', 'unsigned' => false),
		'domingo' => array('type' => 'integer', 'null' => true, 'default' => '1', 'unsigned' => false),
		'h_manana_1' => array('type' => 'time', 'null' => true, 'default' => null),
		'h_manana_2' => array('type' => 'time', 'null' => true, 'default' => null),
		'h_tarde_1' => array('type' => 'time', 'null' => true, 'default' => null),
		'h_tarde_2' => array('type' => 'time', 'null' => true, 'default' => null),
		'pais' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 500, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'municipio' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 500, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'estado' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 500, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'activo' => array('type' => 'integer', 'null' => false, 'default' => '1', 'unsigned' => false),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'updated_at' => array('type' => 'datetime', 'null' => true, 'default' => null),
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
			'usuario_id' => 1,
			'rif' => 'Lorem ipsum dolor sit amet',
			'razon_social' => 'Lorem ipsum dolor sit amet',
			'descripcion' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'representante' => 'Lorem ipsum dolor sit amet',
			'mycartipo_id' => 1,
			'role_id' => 1,
			'orden' => 1,
			'email' => 'Lorem ipsum dolor sit amet',
			'telefono' => 'Lorem ipsum dolor sit amet',
			'website' => 'Lorem ipsum dolor sit amet',
			'direccion' => 'Lorem ipsum dolor sit amet',
			'latitud' => 'Lorem ipsum dolor sit amet',
			'longitud' => 'Lorem ipsum dolor sit amet',
			'foto1' => 'Lorem ipsum dolor sit amet',
			'thumbnail1' => 'Lorem ipsum dolor sit amet',
			'foto2' => 'Lorem ipsum dolor sit amet',
			'foto3' => 'Lorem ipsum dolor sit amet',
			'foto4' => 'Lorem ipsum dolor sit amet',
			'lunes' => 1,
			'martes' => 1,
			'miercoles' => 1,
			'jueves' => 1,
			'viernes' => 1,
			'sabado' => 1,
			'domingo' => 1,
			'h_manana_1' => '14:11:15',
			'h_manana_2' => '14:11:15',
			'h_tarde_1' => '14:11:15',
			'h_tarde_2' => '14:11:15',
			'pais' => 'Lorem ipsum dolor sit amet',
			'municipio' => 'Lorem ipsum dolor sit amet',
			'estado' => 'Lorem ipsum dolor sit amet',
			'activo' => 1,
			'created' => '2020-07-01 14:11:15',
			'modified' => '2020-07-01 14:11:15',
			'updated_at' => '2020-07-01 14:11:15'
		),
	);

}
