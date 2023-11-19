<?php
/**
 * RecargasgifcardpromodetallerFixture
 *
 */
class RecargasgifcardpromodetallerFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'recargasgifcardpromodetaller';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'biginteger', 'null' => false, 'default' => null, 'unsigned' => true, 'key' => 'primary'),
		'recargasgifcardpromo_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'tiposervicio_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'activo' => array('type' => 'integer', 'null' => false, 'default' => '1', 'unsigned' => false),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => null),
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
			'recargasgifcardpromo_id' => 1,
			'tiposervicio_id' => 1,
			'activo' => 1,
			'created' => '2019-06-13 00:02:34',
			'modified' => '2019-06-13 00:02:34'
		),
	);

}
