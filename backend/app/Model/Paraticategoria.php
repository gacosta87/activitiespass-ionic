<?php
App::uses('AppModel', 'Model');
/**
 * Paraticategoria Model
 *
 * @property Paratidetalle $Paratidetalle
 */
class Paraticategoria extends AppModel {

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
		'Paratidetalle' => array(
			'className' => 'Paratidetalle',
			'foreignKey' => 'paraticategoria_id',
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
