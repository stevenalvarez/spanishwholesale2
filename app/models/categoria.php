<?php
class Categoria extends AppModel {
	var $name = 'Categoria';
	var $displayField = 'title';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $hasMany = array(
		'Surtido' => array(
			'className' => 'Surtido',
			'foreignKey' => 'categoria_id',
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
