<?php
/**
 * NfcFixture
 *
 */
class NfcFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'tipocomprobante_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'serie' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 100, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'numeradorinicial' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'numeradorfinal' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'numeradoractual' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'indicadordefinal' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
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
			'tipocomprobante_id' => 1,
			'serie' => 'Lorem ipsum dolor sit amet',
			'numeradorinicial' => 1,
			'numeradorfinal' => 1,
			'numeradoractual' => 1,
			'indicadordefinal' => 1,
			'created' => '2016-10-20 10:58:39',
			'modified' => '2016-10-20 10:58:39'
		),
	);

}
