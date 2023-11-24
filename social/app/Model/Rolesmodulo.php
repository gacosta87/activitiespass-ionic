<?php
App::uses('AppModel', 'Model');
/**
 * Rolesmodulo Model
 *
 * @property Role $Role
 * @property Modulo $Modulo
 */
class Rolesmodulo extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'role_id';

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
		'modulo_id' => array(
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
		'Role' => array(
			'className' => 'Role',
			'foreignKey' => 'role_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Modulo' => array(
			'className' => 'Modulo',
			'foreignKey' => 'modulo_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
