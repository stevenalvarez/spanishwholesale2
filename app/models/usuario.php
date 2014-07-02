<?php
class Usuario extends AppModel {
	var $name = 'Usuario';
	var $displayField = 'title';
	//The Associations below have been created with all possible keys, those that are not needed can be removed
    
    
    	var $validate = array(

		'email' => array(
			'email' => array(
				'rule' => array('email'),
				'message' => 'Email incorrecto',
				'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
            
            'email2' => array(
				'rule' => array('isUnique'),
				'message' => 'Email ya registrado',
				'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
            
            
		),
	);
    
    

	var $belongsTo = array(
		'Regione' => array(
			'className' => 'Regione',
			'foreignKey' => 'regione_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	var $hasMany = array(
		'Calsado' => array(
			'className' => 'Calsado',
			'foreignKey' => 'usuario_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Consulta' => array(
			'className' => 'Consulta',
			'foreignKey' => 'usuario_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Pedido' => array(
			'className' => 'Pedido',
			'foreignKey' => 'usuario_id',
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
    
    public function get_respuesta($id=null){
        $resultado = $this->query("SELECT * FROM consultas Consulta, respuestas Respuesta WHERE Consulta.id = Respuesta.consulta_id AND Respuesta.leido = 0 AND Respuesta.reenviado = 1 AND Consulta.usuario_id='$id'");
        return $resultado;
    }

}
