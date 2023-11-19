<?php
/**
 * ActucievaFixture
 *
 */
class ActucievaFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'biginteger', 'null' => false, 'default' => null, 'unsigned' => true, 'key' => 'primary'),
		'empresa_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'nombre_evaluacion' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 300, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'perido_ciclo_desde' => array('type' => 'date', 'null' => false, 'default' => null),
		'perido_ciclo_hasta' => array('type' => 'date', 'null' => false, 'default' => null),
		'descripcion' => array('type' => 'text', 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'ruta_documento' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 300, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'perido_proceso_desde' => array('type' => 'date', 'null' => false, 'default' => null),
		'perido_proceso_hasta' => array('type' => 'date', 'null' => false, 'default' => null),
		'ruta_planilla' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 300, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'perido_revision_desde' => array('type' => 'date', 'null' => false, 'default' => null),
		'perido_revision_hasta' => array('type' => 'date', 'null' => false, 'default' => null),
		'perido_normalizacion_desde' => array('type' => 'date', 'null' => false, 'default' => null),
		'perido_normalizacion_hasta' => array('type' => 'date', 'null' => false, 'default' => null),
		'aplicable' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'comment' => '1) todos 2) otros'),
		'calificacion' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'comment' => '1) estandar 2) personalizada'),
		'revisado' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'comment' => '1) estandar 2) personalizado'),
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
			'nombre_evaluacion' => 'Lorem ipsum dolor sit amet',
			'perido_ciclo_desde' => '2017-06-17',
			'perido_ciclo_hasta' => '2017-06-17',
			'descripcion' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'ruta_documento' => 'Lorem ipsum dolor sit amet',
			'perido_proceso_desde' => '2017-06-17',
			'perido_proceso_hasta' => '2017-06-17',
			'ruta_planilla' => 'Lorem ipsum dolor sit amet',
			'perido_revision_desde' => '2017-06-17',
			'perido_revision_hasta' => '2017-06-17',
			'perido_normalizacion_desde' => '2017-06-17',
			'perido_normalizacion_hasta' => '2017-06-17',
			'aplicable' => 1,
			'calificacion' => 1,
			'revisado' => 1,
			'activo' => 1,
			'created' => '2017-06-17 21:03:19',
			'modified' => '2017-06-17 21:03:19'
		),
	);

}
