<?php
App::uses('AppModel', 'Model');
/**
 * Mycar Model
 *
 * @property Mycartipo $Mycartipo
 * @property Mycarcalificacione $Mycarcalificacione
 * @property Mycarservicio $Mycarservicio
 * @property Usuario $Usuario
 */
class Mycar extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'razon_social';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Mycartipo' => array(
			'className' => 'Mycartipo',
			'foreignKey' => 'mycartipo_id',
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
		'Mycarcalificacione' => array(
			'className' => 'Mycarcalificacione',
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
		'Mycarservicio' => array(
			'className' => 'Mycarservicio',
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
		)
	);

}
