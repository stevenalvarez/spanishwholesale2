<?php
class Mensaje extends AppModel {
	var $name = 'Mensaje';
	var $displayField = 'tipo_mensaje';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Articulo' => array(
			'className' => 'Articulo',
			'foreignKey' => 'articulo_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
