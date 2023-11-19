<?php
App::uses('AppModel', 'Model');
/**
 * Configuracione Model
 *
 */
class Configuracione extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'denominacion';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'activacion' => array(
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
}
