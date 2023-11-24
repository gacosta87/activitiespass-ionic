<?php
App::uses('AppModel', 'Model');
/**
 * Paratidetalle Model
 *
 * @property Paraticategoria $Paraticategoria
 */
class Paratidetalle extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'titulo';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Paraticategoria' => array(
			'className' => 'Paraticategoria',
			'foreignKey' => 'paraticategoria_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
