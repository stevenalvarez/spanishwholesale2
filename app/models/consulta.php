<?php
class Consulta extends AppModel {
	var $name = 'Consulta';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Usuario' => array(
			'className' => 'Usuario',
			'foreignKey' => 'usuario_id',
			'conditions' => '',
			'fields' => array('Usuario.id','Usuario.title'),
			'order' => ''
		),
		'Calsado' => array(
			'className' => 'Calsado',
			'foreignKey' => 'calsado_id',
			'conditions' => '',
			'fields' => array('Calsado.id','Calsado.code','Calsado.texto'),
			'order' => ''
		),
		'Proveedor' => array(
			'className' => 'Usuario',
			'foreignKey' => 'usuario_prov_id',
			'conditions' => '',
			'fields' => array('Proveedor.id','Proveedor.title'),
			'order' => ''
		)
	);

	var $hasMany = array(
		'Respuesta' => array(
			'className' => 'Respuesta',
			'foreignKey' => 'consulta_id',
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
