<?php
class Surtido extends AppModel {
	var $name = 'Surtido';
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

	var $hasMany = array(
		'Articulo' => array(
			'className' => 'Articulo',
			'foreignKey' => 'surtido_id',
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
