<?php
class Foto extends AppModel {
	var $name = 'Foto';
	var $displayField = 'title';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Calsado' => array(
			'className' => 'Calsado',
			'foreignKey' => 'calsado_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
