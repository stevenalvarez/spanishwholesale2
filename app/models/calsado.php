<?php
class Calsado extends AppModel {
	var $name = 'Calsado';
	var $displayField = 'code';
	//The Associations below have been created with all possible keys, those that are not needed can be removed
    
    var $virtualFields = array(
    'fotos' =>"(select ifnull(count(*),0) from fotos where fotos.calsado_id=Calsado.id)",        
    'surtidos' =>"(select ifnull(count(*),0) from surtidos where surtidos.calsado_id=Calsado.id)");

	var $belongsTo = array(
		/*'Categoria' => array(
			'className' => 'Categoria',
			'foreignKey' => 'categoria_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Tipo' => array(
			'className' => 'Tipo',
			'foreignKey' => 'tipo_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
        
        'Subtipo' => array(
			'className' => 'Subtipo',
			'foreignKey' => 'subtipo_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),*/
		'Usuario' => array(
			'className' => 'Usuario',
			'foreignKey' => 'usuario_id',
			'conditions' => '',// aca se puede poner que el usuario sea de tipo prooveedor 
			'fields' => '',
			'order' => ''
		),
		'Material' => array(
			'className' => 'Material',
			'foreignKey' => 'material_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Country' => array(
			'className' => 'Country',
			'foreignKey' => 'country_id',
			'conditions' => '',
			'fields' => '',
			'order' => 'Country.title desc'
		)
	);

	var $hasMany = array(
		'Foto' => array(
			'className' => 'Foto',
			'foreignKey' => 'calsado_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => 'Foto.id desc',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Surtido' => array(
			'className' => 'Surtido',
			'foreignKey' => 'calsado_id',
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


	var $hasAndBelongsToMany = array(
//		'Color' => array(
//			'className' => 'Color',
//			'joinTable' => 'calsados_colors',
//			'foreignKey' => 'calsado_id',
//			'associationForeignKey' => 'color_id',
//			'unique' => true,
//			'conditions' => '',
//			'fields' => '',
//			'order' => '',
//			'limit' => '',
//			'offset' => '',
//			'finderQuery' => '',
//			'deleteQuery' => '',
//			'insertQuery' => ''
//		),
		'Tag' => array(
			'className' => 'Tag',
			'joinTable' => 'calsados_tags',
			'foreignKey' => 'calsado_id',
			'associationForeignKey' => 'tag_id',
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
