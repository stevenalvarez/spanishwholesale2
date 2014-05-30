<?php
class ArticulosController extends AppController {

	var $name = 'Articulos';

	function index() {
		$this->Articulo->recursive = 0;
		$this->set('articulos', $this->paginate());
	}

//	function view($id = null) {
//		if (!$id) {
//			$this->Session->setFlash(__('Invalid articulo', true));
//			$this->redirect(array('action' => 'index'));
//		}
//		$this->set('articulo', $this->Articulo->read(null, $id));
//	}
//
//	function add() {
//		if (!empty($this->data)) {
//			$this->Articulo->create();
//			if ($this->Articulo->save($this->data)) {
//				$this->Session->setFlash(__('The articulo has been saved', true));
//				$this->redirect(array('action' => 'index'));
//			} else {
//				$this->Session->setFlash(__('The articulo could not be saved. Please, try again.', true));
//			}
//		}
//		$surtidos = $this->Articulo->Surtido->find('list');
//		$pedidos = $this->Articulo->Pedido->find('list');
//		$this->set(compact('surtidos', 'pedidos'));
//	}
//
//	function edit($id = null) {
//		if (!$id && empty($this->data)) {
//			$this->Session->setFlash(__('Invalid articulo', true));
//			$this->redirect(array('action' => 'index'));
//		}
//		if (!empty($this->data)) {
//			if ($this->Articulo->save($this->data)) {
//				$this->Session->setFlash(__('The articulo has been saved', true));
//				$this->redirect(array('action' => 'index'));
//			} else {
//				$this->Session->setFlash(__('The articulo could not be saved. Please, try again.', true));
//			}
//		}
//		if (empty($this->data)) {
//			$this->data = $this->Articulo->read(null, $id);
//		}
//		$surtidos = $this->Articulo->Surtido->find('list');
//		$pedidos = $this->Articulo->Pedido->find('list');
//		$this->set(compact('surtidos', 'pedidos'));
//	}
//
//	function delete($id = null) {
//		if (!$id) {
//			$this->Session->setFlash(__('Invalid id for articulo', true));
//			$this->redirect(array('action'=>'index'));
//		}
//		if ($this->Articulo->delete($id)) {
//			$this->Session->setFlash(__('Articulo deleted', true));
//			$this->redirect(array('action'=>'index'));
//		}
//		$this->Session->setFlash(__('Articulo was not deleted', true));
//		$this->redirect(array('action' => 'index'));
//	}

	function admin_index() {
		
        $this->Articulo->recursive = 3;
        
        if(isset($_GET["search"]) &&  $_GET["search"]==1)
        {
            if($_POST["cliente_id"])
            $this->set('articulos', $this->paginate(array('Pedido.usuario_id'=>$_POST["cliente_id"])));
            if($_POST["cliente_nombre"])            
            {
                
                $this->paginate = array(
                'joins' => array(
                array(
                'alias' => 'Pedidoo',
                'table' => 'pedidos',
                'type' => 'INNER',
                'conditions' => 'Articulo.`pedido_id` = `Pedidoo.`id`'
                ),                
                array(
                'alias' => 'Usuario',
                'table' => 'usuarios',
                'type' => 'INNER',
                'conditions' => '`Usuario`.`id` = `Pedidoo`.`usuario_id`'
                ),
                
                ),
                );
            }
            $this->set('articulos', $this->paginate(null,array( 'Usuario.title like "%'.$_POST["cliente_nombre"].'%"' )));
        }
        
        if(isset($_GET["search"]) &&  $_GET["search"]==1)
        {
        
        }
        else
        $this->set('articulos', $this->paginate());
        
        $total=$this->Articulo->query("SELECT SUM( `articulos`.`total_pedidos` ) as total from `articulos`");
        $this->set('suma', $total["0"]["0"]["total"]);
        $total=$this->Articulo->query("SELECT count( `articulos`.`id` ) as total from `articulos`");
        $this->set('cuantos', $total["0"]["0"]["total"]);
       $this->render('proveedor_index');
	}
    
    function admin_sincompletar() {
		
        $this->Articulo->recursive = 3;
        
        if(isset($_GET["search"]) &&  $_GET["search"]==1)
        {
            if($_POST["cliente_id"])
            $this->set('articulos', $this->paginate(array('Pedido.usuario_id'=>$_POST["cliente_id"])));
            if($_POST["cliente_nombre"])            
            {
                
                $this->paginate = array(
                'joins' => array(
                array(
                'alias' => 'Pedidoo',
                'table' => 'pedidos',
                'type' => 'INNER',
                'conditions' => 'Articulo.`pedido_id` = `Pedidoo.`id` and Articulo.`confirmado` is null and Articulo.`enviado` is null'
                ),                
                array(
                'alias' => 'Usuario',
                'table' => 'usuarios',
                'type' => 'INNER',
                'conditions' => '`Usuario`.`id` = `Pedidoo`.`usuario_id`'
                ),
                
                ),
                );
            }
            $this->set('articulos', $this->paginate(null,array( 'Usuario.title like "%'.$_POST["cliente_nombre"].'%"' )));
        }
        
        if(isset($_GET["search"]) &&  $_GET["search"]==1)
        {
        
        }
        else
        $this->set('articulos', $this->paginate(null,array("Articulo.`confirmado` is null and Articulo.`enviado` is null")));
        
        $total=$this->Articulo->query("SELECT SUM( `articulos`.`total_pedidos` ) as total from `articulos`");
        $this->set('suma', $total["0"]["0"]["total"]);
        $total=$this->Articulo->query("SELECT count( `articulos`.`id` ) as total from `articulos`");
        $this->set('cuantos', $total["0"]["0"]["total"]);
        $this->render('articulos_sincompletar');
	}
    
    function proveedor_index() {
        
      $this->Articulo->recursive = 3;
        
        if(isset($_GET["search"]) &&  $_GET["search"]==1)
        {
            if($_POST["cliente_id"])
            $this->set('articulos', $this->paginate(array('Pedido.usuario_id'=>$_POST["cliente_id"])));
            if($_POST["cliente_nombre"])            
            {
                
                $this->paginate = array(
                'joins' => array(
                array(
                'alias' => 'Pedidoo',
                'table' => 'pedidos',
                'type' => 'INNER',
                'conditions' => 'Articulo.`pedido_id` = `Pedidoo.`id`'
                ),                
                array(
                'alias' => 'Usuario',
                'table' => 'usuarios',
                'type' => 'INNER',
                'conditions' => '`Usuario`.`id` = `Pedidoo`.`usuario_id`'
                ),
                
                ),
                );
            }
            $this->set('articulos', $this->paginate(null,array('Usuario.title'=>$_POST["cliente_nombre"])));
        }
        else
        $this->set('articulos', $this->paginate(array('Articulo.proveedor'=>$this->Auth->user('id'))));
        
        $total=$this->Articulo->query("SELECT SUM( `articulos`.`total_pedidos` ) as total from `articulos`");
        $this->set('suma', $total["0"]["0"]["total"]);
        $total=$this->Articulo->query("SELECT count( `articulos`.`id` ) as total from `articulos`");
        $this->set('cuantos', $total["0"]["0"]["total"]);
	}
     
    function proveedor_clientes() {
        
        $id=$this->Auth->user('id');
		$clientes=$this->Articulo->query("select Usuario.* from `articulos` as Articulo, pedidos as Pedido, usuarios as Usuario
        where Articulo.pedido_id=Pedido.id and Pedido.usuario_id = Usuario.id and Articulo.proveedor =$id GROUP by Usuario.id");
        $this->set('clientes',$clientes);
    //    $this->set('articulos', $this->paginate(null,array(array('Articulo.proveedor'=>$this->Auth->user('id')))));
//        $this->render('index');
	}

	function proveedor_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid articulo', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('articulo', $this->Articulo->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Articulo->create();
			if ($this->Articulo->save($this->data)) {
				$this->Session->setFlash(__('The articulo has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The articulo could not be saved. Please, try again.', true));
			}
		}
		$surtidos = $this->Articulo->Surtido->find('list');
		$pedidos = $this->Articulo->Pedido->find('list');
		$this->set(compact('surtidos', 'pedidos'));
	}
    
    function admin_restore($id = null) {
     
     $this->Articulo->id=$id;
     $restore = $this->Articulo->field("serializado");
     $restore = unserialize($restore);
     $restore["id"]=$id;
     $this->Articulo->save($restore);
     $this->redirect($this->referer());
     exit();
    }
    
    function proveedor_restore($id = null) {
     
     $this->Articulo->id=$id;
     $restore = $this->Articulo->field("serializado");
     $restore = unserialize($restore);
     $restore["id"]=$id;
     $this->Articulo->save($restore);
     $this->redirect($this->referer());
     exit();
    }
    
	function admin_edit($id = null) {
        if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid articulo', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {	 
    
          $this->Articulo->id=$id;
          $pedido=$this->Articulo->read(null,$id);
          
          if($pedido["Articulo"]["tipo"]=='cajas_surtidas')
           {
             $this->data["Articulo"]["base_imponible"]=$this->data["Articulo"]["precio_unitario"]*$this->data["Articulo"]["cantidad"]*$this->data["Articulo"]["pares_caja"];
           }
          else //entones es surtido libre
          {
            $this->data["Articulo"]["base_imponible"]=$this->data["Articulo"]["cantidad"]*$this->data["Articulo"]["precio_unitario"];
          }

          $ivaa=0;
          $reee=0;
          $tax=Configure::read('tax');
          if($this->data["Articulo"]["iva"]=='1')
          {
             $ivaa=$this->data["Articulo"]["base_imponible"]*$tax["iva"]/100;
          }
          
          if($this->data["Articulo"]["re"]=='1')
          {
            $reee=$this->data["Articulo"]["base_imponible"]*$tax["re"]/100;
          }
          
          
          
          $this->data["Articulo"]["suma_total"]=$this->data["Articulo"]["base_imponible"]+$ivaa+$reee;
          
          $this->data["Articulo"]["total_pedidos"]=$this->data["Articulo"]["suma_total"]+$this->data["Articulo"]["portes"];
          
          
			if ($this->Articulo->save($this->data)) {
			 
             
				$this->Session->setFlash(___('Se guardaron los cambios', true));
				$this->redirect(array('controller'=>'pedidos','action' => 'edit',$pedido["Articulo"]["pedido_id"]));
			} else {
				$this->Session->setFlash(__('Error no se pudo guardar', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Articulo->read(null, $id);
            
            $this->Articulo->Surtido->Calsado->recursive=-1;
            $this->data["Calsado"]=$this->Articulo->Surtido->Calsado->find('first',array('conditions'=>array('Calsado.id'=> $this->data["Surtido"]["calsado_id"])));
            $this->Articulo->Surtido->Calsado->Foto-> recursive=-1;
            $this->data["Foto"]=$this->Articulo->Surtido->Calsado->Foto->find('first',array('conditions'=>array('Foto.id'=> $this->data["Articulo"]["foto_id"])));            
            $this->Articulo->Pedido->Usuario->recursive=-1;
            $this->data["Cliente"]=$this->Articulo->Pedido->Usuario->find('first',array('conditions'=>array('Usuario.id'=> $this->data["Pedido"]["usuario_id"])));
           
            }

        $this->loadModel("Usuario");
        $transportistas = $this->Usuario->find('list',array('conditions'=> array('rol'=>'transporte'))) ;
        $this->set(compact('transportistas'));
		$this->set(compact('surtidos', 'pedidos'));
	}
    
	function proveedor_edit($id = null) {
        if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid articulo', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {	 
    
          $this->Articulo->id=$id;
          $pedido=$this->Articulo->read(null,$id);
          
          
          if($pedido["Articulo"]["tipo"]=='cajas_surtidas')
           {
             $this->data["Articulo"]["base_imponible"]=$this->data["Articulo"]["precio_unitario"]*$this->data["Articulo"]["cantidad"]*$this->data["Articulo"]["pares_caja"];
           }
          else //entones es surtido libre
          {
            $this->data["Articulo"]["base_imponible"]=$this->data["Articulo"]["cantidad"]*$this->data["Articulo"]["precio_unitario"];
          }

          $ivaa=0;
          $reee=0;
          $tax=Configure::read('tax');
          if($this->data["Articulo"]["iva"]=='1')
          {
             $ivaa=$this->data["Articulo"]["base_imponible"]*$tax["iva"]/100;
          }
          
          if($this->data["Articulo"]["re"]=='1')
          {
            $reee=$this->data["Articulo"]["base_imponible"]*$tax["re"]/100;
          }
         
          $this->data["Articulo"]["suma_total"]=$this->data["Articulo"]["base_imponible"]+$ivaa+$reee;
          
          $this->data["Articulo"]["total_pedidos"]=$this->data["Articulo"]["suma_total"]+$this->data["Articulo"]["portes"];
          
          
			if ($this->Articulo->save($this->data)) {
			 
				$this->Session->setFlash(___('Se guardaron los cambios', true));
				$this->redirect(array('controller'=>'pedidos','action' => 'edit',$pedido["Articulo"]["pedido_id"]));
			} else {
				$this->Session->setFlash(___('Error no se pudo guardar', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Articulo->read(null, $id);
            
            $this->Articulo->Surtido->Calsado->recursive=-1;
            $this->data["Calsado"]=$this->Articulo->Surtido->Calsado->find('first',array('conditions'=>array('Calsado.id'=> $this->data["Surtido"]["calsado_id"])));
            $this->Articulo->Surtido->Calsado->Foto-> recursive=-1;
            $this->data["Foto"]=$this->Articulo->Surtido->Calsado->Foto->find('first',array('conditions'=>array('Foto.id'=> $this->data["Articulo"]["foto_id"])));            
            $this->Articulo->Pedido->Usuario->recursive=-1;
            $this->data["Cliente"]=$this->Articulo->Pedido->Usuario->find('first',array('conditions'=>array('Usuario.id'=> $this->data["Pedido"]["usuario_id"])));
            
            }

        $this->loadModel("Usuario");
        $transportistas = $this->Usuario->find('list',array('conditions'=> array('rol'=>'transporte'))) ;
        $this->set(compact('transportistas'));
		$this->set(compact('surtidos', 'pedidos'));
	}
        
    	function cliente_view($id = null) {
        if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid articulo', true));
			$this->redirect(array('action' => 'index'));
		}
		if (empty($this->data)) 
        {
			$this->data = $this->Articulo->read(null, $id);
            $this->Articulo->Surtido->Calsado->recursive=-1;
            
            $this->data["Calsado"]=$this->Articulo->Surtido->Calsado->find('first',array('conditions'=>array('Calsado.id'=> $this->data["Surtido"]["calsado_id"])));
            $this->Articulo->Surtido->Calsado->Foto-> recursive=-1;
            $this->data["Foto"]=$this->Articulo->Surtido->Calsado->Foto->find('first',array('conditions'=>array('Foto.id'=> $this->data["Articulo"]["foto_id"])));            
           // $this->Articulo->Pedido->Usuario->recursive=-1;
         //   $this->data["Cliente"]=$this->Articulo->Pedido->Usuario->find('first',array('conditions'=>array('Usuario.id'=> $this->data["Pedido"]["usuario_id"])));
//            
//            pr( $this->data);
//            exit();
            
        }
            
		//$surtidos = $this->Articulo->Surtido->find('list');
		//$pedidos = $this->Articulo->Pedido->find('list');
		$this->set(compact('surtidos', 'pedidos'));
        	$this->layout='default';
                
	}
    
    
    //////////////////////////////////////////////////////////////////////////////
	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for articulo', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Articulo->delete($id)) {
			$this->Session->setFlash(___('El articulo fue eliminado', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Articulo was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
    
    	function cliente_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for articulo', true));
			$this->redirect(array('action'=>'index'));
		}
        $art =  $this->Articulo->read(null,$id);
        if($art["Pedido"]["usuario_id"]== $this->Auth->user("id") && $art["Pedido"]["confirmado"] != '1' )
        {      
		if ($this->Articulo->delete($id)) {
		  
          $this->loadModel("Pedido");
          $pedido = $this->Pedido->read(null,$art["Pedido"]["id"]);
          if(sizeof($pedido["Articulo"])==0)
          {
            $this->Pedido->delete($pedido["Pedido"]["id"]);
          }          
			$this->Session->setFlash(___('El articulo fue eliminado', true));
		}
		$this->redirect($this->referer());
        }
        	$this->redirect($this->referer());
            exit();
	}
    
    
   function proveedor_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for articulo', true));
			$this->redirect(array('action'=>'index'));
		}
        $this->Articulo->recursive=1;
        $this->Articulo->id=$id;
        
        $this->loadModel("Basurero");
        $basura["tipo"]='articulo';
        $basura["borrador"]=$this->Auth->user("id");
        $basura["datos"]=serialize($this->Articulo->read());
        $this->Basurero->save($basura);
        
		if ($this->Articulo->delete($id)) {
			$this->Session->setFlash(___('El articulo fue eliminado', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Articulo was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
    
    function admin_mensajeobserva($id)
    {        
        $this->Articulo->id=$id;
        $this->Articulo->saveField('confirmado',$_POST["confirmado"]);
        App::import('Sanitize');        
        $mesaje["Mensaje"]["mensaje"]=Sanitize::clean($_POST["texto"], array('encode' => false,'remove_html' => array('remove'=>true),'escape'=>false,'carriage'=>false));
        $mesaje["Mensaje"]["tim"]= DboSource::expression('NOW()');
        $mesaje["Mensaje"]["tipo_mensaje"]= 'observa';
        $mesaje["Mensaje"]["articulo_id"]= $this->data["Articulo"]["id"];
        $this->Articulo->Mensaje->save($mesaje);        
        $this->redirect(array('action'=>'edit',$this->data["Articulo"]["id"]."#second"));        
    }
    
        function admin_mensajeesperando($id)
    {        
        $this->Articulo->id=$id;
        $this->Articulo->saveField('esperando_mercancia',$_POST["confirmado"]);
        App::import('Sanitize');        
        $mesaje["Mensaje"]["mensaje"]=Sanitize::clean($_POST["texto"], array('encode' => false,'remove_html' => array('remove'=>true),'escape'=>false,'carriage'=>false));
        $mesaje["Mensaje"]["tim"]= DboSource::expression('NOW()');
        $mesaje["Mensaje"]["tipo_mensaje"]= 'esperando';
        $mesaje["Mensaje"]["articulo_id"]= $this->data["Articulo"]["id"];
        $this->Articulo->Mensaje->save($mesaje);        
        $this->redirect(array('action'=>'edit',$this->data["Articulo"]["id"]."#second"));        
    }
            function admin_enviado($id)
    {        
        $this->Articulo->id=$id;
        $this->Articulo->saveField('enviado',$_POST["confirmado"]);
        $this->Articulo->saveField('empresa_transporte',$_POST["empresa_transporte"]);
        $this->Articulo->saveField('fecha_salida',$_POST["fecha_salida"]);
        $this->redirect(array('action'=>'edit',$this->data["Articulo"]["id"]."#second"));        
    }
    
            function admin_anulado($id)
    {        
        $this->Articulo->id=$id;
        $this->Articulo->saveField('anulado',$_POST["confirmado"]);
        $this->Articulo->saveField('causa_anulacion',$_POST["causa_anulacion"]);
        $this->redirect(array('action'=>'edit',$this->data["Articulo"]["id"]."#second"));        
    }
    
    
    ////////////////////
    
        function proveedor_mensajeobserva($id)
    {        
        $this->Articulo->id=$id;
        $this->Articulo->saveField('confirmado',$_POST["confirmado"]);
        App::import('Sanitize');        
        $mesaje["Mensaje"]["mensaje"]=Sanitize::clean($_POST["texto"], array('encode' => false,'remove_html' => array('remove'=>true),'escape'=>false,'carriage'=>false));
        $mesaje["Mensaje"]["tim"]= DboSource::expression('NOW()');
        $mesaje["Mensaje"]["tipo_mensaje"]= 'observa';
        $mesaje["Mensaje"]["articulo_id"]= $this->data["Articulo"]["id"];
        $this->Articulo->Mensaje->save($mesaje);        
        $this->redirect(array('action'=>'edit',$this->data["Articulo"]["id"]."#second"));        
    }
    
        function proveedor_mensajeesperando($id)
    {        
        $this->Articulo->id=$id;
        $this->Articulo->saveField('esperando_mercancia',$_POST["confirmado"]);
        App::import('Sanitize');        
        $mesaje["Mensaje"]["mensaje"]=Sanitize::clean($_POST["texto"], array('encode' => false,'remove_html' => array('remove'=>true),'escape'=>false,'carriage'=>false));
        $mesaje["Mensaje"]["tim"]= DboSource::expression('NOW()');
        $mesaje["Mensaje"]["tipo_mensaje"]= 'esperando';
        $mesaje["Mensaje"]["articulo_id"]= $this->data["Articulo"]["id"];
        $this->Articulo->Mensaje->save($mesaje);        
        $this->redirect(array('action'=>'edit',$this->data["Articulo"]["id"]."#second"));        
    }
        function proveedor_enviado($id)
    {        
        $this->Articulo->id=$id;
        $this->Articulo->saveField('enviado',$_POST["confirmado"]);
        $this->Articulo->saveField('empresa_transporte',$_POST["empresa_transporte"]);
        $this->Articulo->saveField('fecha_salida',$_POST["fecha_salida"]);
        $this->redirect(array('action'=>'edit',$this->data["Articulo"]["id"]."#second"));        
    }
    
        function proveedor_anulado($id)
    {        
        $this->Articulo->id=$id;
        $this->Articulo->saveField('anulado',$_POST["confirmado"]);
        $this->Articulo->saveField('causa_anulacion',$_POST["causa_anulacion"]);
        $this->redirect(array('action'=>'edit',$this->data["Articulo"]["id"]."#second"));        
    }
    
        function proveedor_serializar_valores()
    {
        $this->Articulo->recursive = -1;
        $articulos = $this->Articulo->find("all",array("fields"=>array("id","unidades","precio_unitario","bultos")));
        
        foreach($articulos as $articulo){
            $this->Articulo->id = $articulo["Articulo"]["id"];
            $this->Articulo->saveField("serializado", serialize($articulo));
        }
        exit();
    }
    
}
