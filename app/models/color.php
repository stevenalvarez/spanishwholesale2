<?php
class Color extends AppModel {
	var $name = 'Color';
	var $displayField = 'title';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $hasAndBelongsToMany = array(
		'Calsado' => array(
			'className' => 'Calsado',
			'joinTable' => 'calsados_colors',
			'foreignKey' => 'color_id',
			'associationForeignKey' => 'calsado_id',
			'unique' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		)
	);

}
