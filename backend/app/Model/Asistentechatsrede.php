<?php
App::uses('AppModel', 'Model');
/**
 * Asistentechatsrede Model
 *
 * @property Sender $Sender
 * @property Recipient $Recipient
 * @property Mensaje $Mensaje
 */
class Asistentechatsrede extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'id';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Mensaje' => array(
			'className' => 'Mensaje',
			'foreignKey' => 'mensaje_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
