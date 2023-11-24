<?php
App::uses('AppModel', 'Model');
/**
 * Chatpromt Model
 *
 * @property Chatcategoria $Chatcategoria
 */
class Chatpromt extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'denomincion';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Chatcategoria' => array(
			'className' => 'Chatcategoria',
			'foreignKey' => 'chatcategoria_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
