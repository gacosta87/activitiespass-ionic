<?php
App::uses('AppModel', 'Model');
/**
 * Usuario Model
 *
 * @property Mycar $Mycar
 * @property Role $Role
 * @property Busqueda $Busqueda
 * @property Historialpushusuario $Historialpushusuario
 * @property Mycarcalificacione $Mycarcalificacione
 * @property Mycarclientehistoriale $Mycarclientehistoriale
 * @property Mycarcliente $Mycarcliente
 * @property Mycar $Mycar
 * @property MycarsValoracionTotal $MycarsValoracionTotal
 * @property Mycarsfavorito $Mycarsfavorito
 * @property Mycarstipcalificacione $Mycarstipcalificacione
 * @property Publicacione $Publicacione
 * @property PublicacionesLike $PublicacionesLike
 * @property Publicacioneslike $Publicacioneslike
 * @property Sugerencia $Sugerencia
 * @property Valoracione $Valoracione
 */
class Usuario extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'username';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'mycar_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'role_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'clave' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'verificado' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Mycar' => array(
			'className' => 'Mycar',
			'foreignKey' => 'mycar_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Role' => array(
			'className' => 'Role',
			'foreignKey' => 'role_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Mycar' => array(
			'className' => 'Mycar',
			'foreignKey' => 'usuario_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	
	);

}
