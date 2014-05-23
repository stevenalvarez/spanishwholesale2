<?php
class Tag extends AppModel {
	var $name = 'Tag';
	var $displayField = 'title';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $hasAndBelongsToMany = array(
		'Calsado' => array(
			'className' => 'Calsado',
			'joinTable' => 'calsados_tags',
			'foreignKey' => 'tag_id',
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
