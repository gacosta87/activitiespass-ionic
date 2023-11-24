<?php
/**
 * UsuarioFixture
 *
 */
class UsuarioFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'biginteger', 'null' => false, 'default' => null, 'unsigned' => true, 'key' => 'primary'),
		'mycar_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'role_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'username' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 500, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'tiporegistro' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'foto' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'thumbnail1' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 1000, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'foto2' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'fotourl' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 500, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'clave' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 500, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'ci' => array('type' => 'string', 'null' => true, 'length' => 20, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'telefono' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 20, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'nombre_apellido' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 300, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'nombres' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 500, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'apellidos' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 500, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'password' => array('type' => 'string', 'null' => true, 'default' => '$2y$10$k37Q1vPWSV33CUgBX2u32uRk7rVQHelHG4kflq/6v7lie0TV.ZqOu', 'length' => 100, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'email' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 500, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'recuperar' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'verificado' => array('type' => 'integer', 'null' => false, 'default' => '1', 'unsigned' => false),
		'fechaingreso' => array('type' => 'timestamp', 'null' => false, 'default' => null),
		'date' => array('type' => 'date', 'null' => true, 'default' => null),
		'push_token' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 500, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'push_platf' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 500, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'codigo_recuperacion' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 10, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'codigo_compartir' => array('type' => 'string', 'null' => true, 'default' => '0', 'length' => 50, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'registroid' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'updated_at' => array('type' => 'timestamp', 'null' => true, 'default' => null),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'id' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => '',
			'mycar_id' => 1,
			'role_id' => 1,
			'username' => 'Lorem ipsum dolor sit amet',
			'tiporegistro' => 1,
			'foto' => 'Lorem ipsum dolor sit amet',
			'thumbnail1' => 'Lorem ipsum dolor sit amet',
			'foto2' => 'Lorem ipsum dolor sit amet',
			'fotourl' => 'Lorem ipsum dolor sit amet',
			'clave' => 'Lorem ipsum dolor sit amet',
			'ci' => 'Lorem ipsum dolor ',
			'telefono' => 'Lorem ipsum dolor ',
			'nombre_apellido' => 'Lorem ipsum dolor sit amet',
			'nombres' => 'Lorem ipsum dolor sit amet',
			'apellidos' => 'Lorem ipsum dolor sit amet',
			'password' => 'Lorem ipsum dolor sit amet',
			'email' => 'Lorem ipsum dolor sit amet',
			'recuperar' => 'Lorem ipsum dolor sit amet',
			'verificado' => 1,
			'fechaingreso' => 1593623450,
			'date' => '2020-07-01',
			'push_token' => 'Lorem ipsum dolor sit amet',
			'push_platf' => 'Lorem ipsum dolor sit amet',
			'codigo_recuperacion' => 'Lorem ip',
			'codigo_compartir' => 'Lorem ipsum dolor sit amet',
			'registroid' => 'Lorem ipsum dolor sit amet',
			'modified' => '2020-07-01 14:10:50',
			'updated_at' => 1593623450,
			'created' => '2020-07-01 14:10:50'
		),
	);

}
