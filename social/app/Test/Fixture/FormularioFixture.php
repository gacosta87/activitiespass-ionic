<?php
/**
 * FormularioFixture
 *
 */
class FormularioFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'biginteger', 'null' => false, 'default' => null, 'unsigned' => true, 'key' => 'primary'),
		'empresa_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'empresasurcusale_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'departamento_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'seccione_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'gerente_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'subgerente_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'sistema_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'nombre_del_usuario' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 300, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'fecha_solicitud' => array('type' => 'date', 'null' => false, 'default' => null),
		'cargo_actual_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'cargo_nuevo_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'tiempo_expiracion' => array('type' => 'date', 'null' => false, 'default' => null),
		'statuspas_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'motivo' => array('type' => 'text', 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
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
			'empresasurcusale_id' => 1,
			'departamento_id' => 1,
			'seccione_id' => 1,
			'gerente_id' => 1,
			'subgerente_id' => 1,
			'sistema_id' => 1,
			'nombre_del_usuario' => 'Lorem ipsum dolor sit amet',
			'fecha_solicitud' => '2018-05-16',
			'cargo_actual_id' => 1,
			'cargo_nuevo_id' => 1,
			'tiempo_expiracion' => '2018-05-16',
			'statuspas_id' => 1,
			'motivo' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'activo' => 1,
			'created' => '2018-05-16 14:50:10',
			'modified' => '2018-05-16 14:50:10'
		),
	);

}
