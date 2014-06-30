<?php
class Pedido extends AppModel {
	var $name = 'Pedido';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Usuario' => array(
			'className' => 'Usuario',
			'foreignKey' => 'usuario_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	var $hasMany = array(
		'Articulo' => array(
			'className' => 'Articulo',
			'foreignKey' => 'pedido_id',
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
		'Mensaje' => array(
			'className' => 'Mensaje',
			'foreignKey' => 'pedido_id',
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
    
    function calcularTotal($pedido_id)
    {
        $neto=$this->calcularTotalneto($pedido_id);
        $portes=$this->calcularPortes($pedido_id);
        
        $pedido = $this->query("select * from pedidos p where  p.id=$pedido_id");
        
        $impuestos=0;
        if($pedido["0"]["p"]["iva"])
        $impuestos=$neto*$pedido["0"]["p"]["ivasave"]/100;
        if($pedido["0"]["p"]["re"])
        $impuestos=$impuestos+$neto*$pedido["0"]["p"]["resave"]/100;
        
        $total=$impuestos+$neto;
        
        return number_format($total,2,",",".");
        
    }
    
    
    function calcularTotalneto($pedido_id)
    {
        
        $sql="select * from `articulos` a where  a.pedido_id =$pedido_id";
        $pedidos = $this->query($sql);
        $total=0;
        foreach($pedidos as $pedido)
        {
          $pedido=$pedido["a"];
          
         if($pedido["tipo"]=='cajas_surtidas')
         $total=$total+$pedido["precio_unitario"]*$pedido["unidades"]*$pedido["bultos"];
          else
         $total=$total+$pedido["precio_unitario"]*$pedido["unidades"];
        }
        $portes=$this->calcularPortes($pedido_id);
        return $total+$portes;
    }
    
        function calcularTotalneto_sinportes($pedido_id)
    {
        
        $sql="select * from `articulos` a where  a.pedido_id =$pedido_id";
        $pedidos = $this->query($sql);
        $total=0;
        foreach($pedidos as $pedido)
        {
          $pedido=$pedido["a"];
          
         if($pedido["tipo"]=='cajas_surtidas')
         $total=$total+$pedido["precio_unitario"]*$pedido["unidades"]*$pedido["bultos"];
          else
         $total=$total+$pedido["precio_unitario"]*$pedido["unidades"];
        }
       
        return $total;
    }
    
    
    function calcularPortes($pedido_id)
    {
        
       $this->id=$pedido_id;
       $portes=$this->field("portes");
       
       
       if($portes)
       return $portes;
       else
       {
       $portes=$this->query("select u.portes_txt, u.portes from usuarios u,pedidos p where p.id=$pedido_id and p.proveedor=u.id");
       
       $portres=0;
         if(isset($portes[0]['u']["portes"]) && $portes[0]['u']["portes"]=='bultos')
         {
            $serializadoo=unserialize($portes[0]['u']['portes_txt']);
            ksort($serializadoo);    
         
            $cajillas_portes=$this->calcularbultos($pedido_id); 
            $cajillas_portes_orig=ceil($cajillas_portes);                         
            $bandera=1;
            $portres=0;
             $reajustar=0;
            while($bandera && $cajillas_portes>0)
            {
                if(isset($serializadoo[$cajillas_portes]) && $serializadoo[$cajillas_portes] ) 
                {
                    $portres=$serializadoo[$cajillas_portes]*$cajillas_portes;
                    $bandera=0;
                }
                else
                {
                                $reajustar=1;
                                $cajillas_portes--;    
                }
            }
            if($reajustar)
            {
                if($cajillas_portes*$cajillas_portes_orig > 0){
                    $portres=$portres/$cajillas_portes*$cajillas_portes_orig;
                }
            }
         }
         else
         {
            $serializadoo=isset($portes[0]['u']["portes"]) ? @unserialize($portes[0]['u']["portes"]) : array();
            $total=$this->calcularTotalneto_sinportes($pedido_id);
            
            if(!empty($serializadoo) && intval($serializadoo["mayor"])<= intval($total))
            {
                $portres=0;
            }
            else{
                $portres=!empty($serializadoo) ? $serializadoo["porenvio"] : 0;
            }
         }
          return $portres;
        }  
    }
    
    function calcularbultos($pedido_id)
    {
       $pedidos=$this->query("select * from articulos where pedido_id=$pedido_id");
       $cajillas_portes=0;       
       foreach($pedidos as $pedido)
       {
            if($pedido["articulos"]["tipo"]=="surtido_libre")
             {
                $cajillas_portes=$cajillas_portes+$pedido["articulos"]["unidades"]/12;
             }else{
                $cajillas_portes=$cajillas_portes+$pedido["articulos"]["bultos"];
             }
        
       }
       
       return ceil($cajillas_portes);
    }
    
    
    
    
  

}
