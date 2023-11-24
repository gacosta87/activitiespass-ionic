<?php
App::uses('AppModel', 'Model');
/**
 * Mycar Model
 *
 * @property Usuario $Usuario
 * @property Mycartipo $Mycartipo
 * @property Role $Role
 * @property Mycarcalificacione $Mycarcalificacione
 * @property Mycarclientehistoriale $Mycarclientehistoriale
 * @property Mycarcliente $Mycarcliente
 * @property Mycarservicio $Mycarservicio
 * @property Mycarsfavorito $Mycarsfavorito
 * @property Mycartag $Mycartag
 * @property Mycartagsbusqueda $Mycartagsbusqueda
 * @property Publicacione $Publicacione
 * @property PublicacionesLike $PublicacionesLike
 * @property Publicacioneslike $Publicacioneslike
 * @property Usuario $Usuario
 * @property Valoracione $Valoracione
 */
class Mycar extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'id';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
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
		'activo' => array(
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
		'Usuario' => array(
			'className' => 'Usuario',
			'foreignKey' => 'usuario_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Mycartipo' => array(
			'className' => 'Mycartipo',
			'foreignKey' => 'mycartipo_id',
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
		'Publicacione' => array(
			'className' => 'Publicacione',
			'foreignKey' => 'mycar_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Usuario' => array(
			'className' => 'Usuario',
			'foreignKey' => 'mycar_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		
	);

}
