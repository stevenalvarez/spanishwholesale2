<?php
class Respuesta extends AppModel {
	var $name = 'Respuesta';
	var $displayField = 'title';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Consulta' => array(
			'className' => 'Consulta',
			'foreignKey' => 'consulta_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
