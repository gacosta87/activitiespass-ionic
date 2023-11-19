<?php
/**
 * BannerFixture
 *
 */
class BannerFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'banner';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'biginteger', 'null' => false, 'default' => null, 'unsigned' => true, 'key' => 'primary'),
		'tipo' => array('type' => 'integer', 'null' => false, 'default' => '1', 'unsigned' => false, 'comment' => '1 inicio, 2 buscar'),
		'url_banner' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 500, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'activo' => array('type' => 'integer', 'null' => false, 'default' => '1', 'unsigned' => false),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			
		),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'MyISAM')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => '',
			'tipo' => 1,
			'url_banner' => 'Lorem ipsum dolor sit amet',
			'activo' => 1,
			'created' => '2022-08-17 17:07:07',
			'modified' => '2022-08-17 17:07:07'
		),
	);

}
