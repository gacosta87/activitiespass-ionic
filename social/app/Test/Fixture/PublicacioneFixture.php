<?php
/**
 * PublicacioneFixture
 *
 */
class PublicacioneFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'biginteger', 'null' => false, 'default' => null, 'unsigned' => true, 'key' => 'primary'),
		'usuario_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'mycar_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'imagen1' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8mb4_general_ci', 'charset' => 'utf8mb4'),
		'imagen1_m' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 1000, 'collate' => 'utf8mb4_general_ci', 'charset' => 'utf8mb4'),
		'imagen2' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8mb4_general_ci', 'charset' => 'utf8mb4'),
		'imagen3' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8mb4_general_ci', 'charset' => 'utf8mb4'),
		'thumbnail1' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 500, 'collate' => 'utf8mb4_general_ci', 'charset' => 'utf8mb4'),
		'thumbnail2' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 500, 'collate' => 'utf8mb4_general_ci', 'charset' => 'utf8mb4'),
		'thumbnail3' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 500, 'collate' => 'utf8mb4_general_ci', 'charset' => 'utf8mb4'),
		'tipo' => array('type' => 'integer', 'null' => true, 'default' => '1', 'unsigned' => false),
		'texto' => array('type' => 'text', 'null' => false, 'default' => null, 'collate' => 'utf8mb4_general_ci', 'charset' => 'utf8mb4'),
		'activo' => array('type' => 'integer', 'null' => true, 'default' => '1', 'unsigned' => false),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'id' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8mb4', 'collate' => 'utf8mb4_general_ci', 'engine' => 'InnoDB')
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
			'mycar_id' => 1,
			'imagen1' => 'Lorem ipsum dolor sit amet',
			'imagen1_m' => 'Lorem ipsum dolor sit amet',
			'imagen2' => 'Lorem ipsum dolor sit amet',
			'imagen3' => 'Lorem ipsum dolor sit amet',
			'thumbnail1' => 'Lorem ipsum dolor sit amet',
			'thumbnail2' => 'Lorem ipsum dolor sit amet',
			'thumbnail3' => 'Lorem ipsum dolor sit amet',
			'tipo' => 1,
			'texto' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'activo' => 1,
			'created' => '2020-07-01 14:11:31',
			'modified' => '2020-07-01 14:11:31'
		),
	);

}
