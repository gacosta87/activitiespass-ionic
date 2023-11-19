<?php
/**
 * Organigrama8Fixture
 *
 */
class Organigrama8Fixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'biginteger', 'null' => false, 'default' => null, 'unsigned' => true, 'key' => 'primary'),
		'empresa_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'organigrama1_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'organigrama2_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'organigrama3_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'organigrama4_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'organigrama5_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'organigrama6_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'organigrama7_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'denominacion' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 300, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'encargado' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 300, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'observaciones' => array('type' => 'text', 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
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
			'organigrama1_id' => 1,
			'organigrama2_id' => 1,
			'organigrama3_id' => 1,
			'organigrama4_id' => 1,
			'organigrama5_id' => 1,
			'organigrama6_id' => 1,
			'organigrama7_id' => 1,
			'denominacion' => 'Lorem ipsum dolor sit amet',
			'encargado' => 'Lorem ipsum dolor sit amet',
			'observaciones' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'activo' => 1,
			'created' => '2017-06-12 20:59:04',
			'modified' => '2017-06-12 20:59:04'
		),
	);

}
