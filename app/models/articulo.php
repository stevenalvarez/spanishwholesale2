<?php
class Articulo extends AppModel {
	var $name = 'Articulo';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Surtido' => array(
			'className' => 'Surtido',
			'foreignKey' => 'surtido_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Pedido' => array(
			'className' => 'Pedido',
			'foreignKey' => 'pedido_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
    
    
    
//    	var $hasMany = array(
//		'Mensaje' => array(
//			'className' => 'Mensaje',
//			'foreignKey' => 'articulo_id',
//			'dependent' => false,
//			'conditions' => '',
//			'fields' => '',
//			'order' => '',
//			'limit' => '',
//			'offset' => '',
//			'exclusive' => '',
//			'finderQuery' => '',
//			'counterQuery' => ''
//		)
//	);
//    
    
    
    
    
    
    
}
