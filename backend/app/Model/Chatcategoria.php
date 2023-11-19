<?php
App::uses('AppModel', 'Model');
/**
 * Chatcategoria Model
 *
 * @property Chatpromt $Chatpromt
 */
class Chatcategoria extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'denominacion';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Chatpromt' => array(
			'className' => 'Chatpromt',
			'foreignKey' => 'chatcategoria_id',
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
