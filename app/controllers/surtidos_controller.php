<?php
class SurtidosController extends AppController {

	var $name = 'Surtidos';


	function admin_add() {

		if (!empty($this->data)) {
			$this->Surtido->create();
            $this->data["Surtido"]["tim"] = date("Y-m-d H:i:s");
            if($this->data["Surtido"]["tipo"]=='cajas_surtidas')
          {
            ////////////////////*********************************************************
           $pares=explode('-',$this->data["Surtido"]["descripcion"]);    
           $contador=0;
           $parecilos=array();
           foreach($pares as  $k=>$v)
           {
            if($v)
            {
                $parecilos[]=intval($v);
                $contador=$contador+intval($v);
            }
           }               
           $this->data["Surtido"]["pares"]=$contador;
           $this->data["Surtido"]["descripcion"]=implode("-",$parecilos);
           }
         //////////////////////////////////////***************************************** 
			if ($this->Surtido->save($this->data)) {

               
               $this->Session->setFlash(__('Se guardo el surtido', true));
				$this->redirect(array('controller'=>'calsados','action' => 'edit',$this->data["Surtido"]["calsado_id"]."#admin-table"  ));
			} else {
				$this->Session->setFlash(__('no se pudo guardar, datos incorrectos', true));
                $this->redirect($this->referer());
			}
		}
		$calsados = $this->Surtido->Calsado->find('list');
		$this->set(compact('calsados'));
	}
    
    function proveedor_add() {

		if (!empty($this->data)) {
		  $this->data["Surtido"]["tim"] = date("Y-m-d H:i:s");
		  if($this->data["Surtido"]["tipo"]=='cajas_surtidas')
          {
		  ////////////////////*********************************************************
           $pares=explode('-',$this->data["Surtido"]["descripcion"]);    
           $contador=0;
           $parecilos=array();
           foreach($pares as  $k=>$v)
           {
            if($v)
            {
                $parecilos[]=intval($v);
                $contador=$contador+intval($v);
            }
           }               
           $this->data["Surtido"]["pares"]=$contador;
           $this->data["Surtido"]["descripcion"]=implode("-",$parecilos);
           }
         //////////////////////////////////////***************************************** 

			$this->Surtido->create();
			if ($this->Surtido->save($this->data)) {
				$this->Session->setFlash(__('Se guardo el surtido', true));
				$this->redirect(array('controller'=>'calsados','action' => 'edit',$this->data["Surtido"]["calsado_id"]."#admin-table"  ));
			} else {
				$this->Session->setFlash(__('no se pudo guardar, datos incorrectos', true));
                $this->redirect($this->referer());
			}
		}
		$calsados = $this->Surtido->Calsado->find('list');
		$this->set(compact('calsados'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid surtido', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
		  
          $this->Surtido->id=$id;
        $calsado_id=$this->Surtido->field('calsado_id');
        $tipo=$this->Surtido->field('tipo');
         ////////////////////*********************************************************
         
         if($tipo=='cajas_surtidas')
       {
           $pares=explode('-',$this->data["Surtido"]["descripcion"]);    
           $contador=0;
           $parecilos=array();
           foreach($pares as  $k=>$v)
           {
            if($v)
            {
                $parecilos[]=intval($v);
                $contador=$contador+intval($v);
            }
           }               
           $this->data["Surtido"]["pares"]=$contador;
           $this->data["Surtido"]["descripcion"]=implode("-",$parecilos);
       }  
         //////////////////////////////////////***************************************** 
        
			if ($this->Surtido->save($this->data)) {
				$this->Session->setFlash(__('The surtido has been saved', true));
				$this->redirect(array('controller'=>'calsados','action' => 'edit',$calsado_id."#admin-table"  ));
			} else {
				$this->Session->setFlash(__('The surtido could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Surtido->read(null, $id);
		}
        $calsados = $this->Surtido->Calsado->find('list');
        $categorias = $this->Surtido->Calsado->Categoria->find('list');
        $tipos = $this->Surtido->Calsado->Tipo->find('list');
        $subtipos = $this->Surtido->Calsado->Subtipo->find('list');
		$this->set(compact('calsados','categorias','tipos','subtipos'));
	}
    
    function proveedor_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid surtido', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
		  
          $this->Surtido->id=$id;
        $calsado_id=$this->Surtido->field('calsado_id');
        $tipo=$this->Surtido->field('tipo');
         ////////////////////*********************************************************
         
         if($tipo=='cajas_surtidas')
       {
           $pares=explode('-',$this->data["Surtido"]["descripcion"]);    
           $contador=0;
           $parecilos=array();
           foreach($pares as  $k=>$v)
           {
            if($v)
            {
                $parecilos[]=intval($v);
                $contador=$contador+intval($v);
            }
           }               
           $this->data["Surtido"]["pares"]=$contador;
           $this->data["Surtido"]["descripcion"]=implode("-",$parecilos);
       }    
         //////////////////////////////////////***************************************** 
        
			if ($this->Surtido->save($this->data)) {
				$this->Session->setFlash(__('The surtido has been saved', true));
				$this->redirect(array('controller'=>'calsados','action' => 'edit',$calsado_id."#admin-table"  ));
			} else {
				$this->Session->setFlash(__('The surtido could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Surtido->read(null, $id);
		}
		$calsados = $this->Surtido->Calsado->find('list');
        $categorias = $this->Surtido->Calsado->Categoria->find('list');
        $tipos = $this->Surtido->Calsado->Tipo->find('list');
        $subtipos = $this->Surtido->Calsado->Subtipo->find('list');
		$this->set(compact('calsados','categorias','tipos','subtipos'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for surtido', true));
			$this->redirect(array('action'=>'index'));
		}
        
        $this->Surtido->id=$id;
        $calsado_id=$this->Surtido->field('calsado_id');
        
		if ($this->Surtido->delete($id)) {
		$this->redirect(array('controller'=>'calsados','action' => 'edit',$calsado_id."#admin-table"  ));
		//	$this->redirect(array('action'=>'index'));
		}
        else
        {
            $this->Session->setFlash(__('No se puede eliminar debido a que existen pedidos con este surtido', true));
            $this->redirect(array('controller'=>'calsados','action' => 'edit',$calsado_id."flashMessage"  ));
        }
		//$this->Session->setFlash(__('Surtido was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
    
    function admin_ajaxdelete($id = null) {
		if (!$id)
        {
         exit();
		}
		if ($this->Surtido->delete($id)) {		
            echo "$(this).parent('').parent('').slideUp();
            var td=$(this).parent('').parent('').parent('').children('tr.colspan').children(td);
            var x=$(td).attr('rowspan');
            $(td).attr('rowspan',(x*1)-1);";
            exit();}
        else
        {
            echo "alert('No se puede eliminar debido a que existen pedidos con este surtido');";
        }
        exit();
	}
    
        function proveedor_ajaxdelete($id = null) {
		if (!$id)
        {
         exit();
		}
		if ($this->Surtido->delete($id)) {		
            echo "$(this).parent('').parent('').slideUp();
            var td=$(this).parent('').parent('').parent('').children('tr.colspan').children(td);
            var x=$(td).attr('rowspan');
            $(td).attr('rowspan',(x*1)-1);";
            exit();}
        else
        {
            echo "alert('No se puede eliminar debido a que existen pedidos con este surtido');";
        }
        exit();
	}
    
    
    
    function proveedor_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for surtido', true));
			$this->redirect(array('action'=>'index'));
		}
        
        $this->Surtido->id=$id;
        $calsado_id=$this->Surtido->field('calsado_id');
        
		if ($this->Surtido->delete($id)) {
		$this->redirect(array('controller'=>'calsados','action' => 'edit',$calsado_id."#admin-table"  ));
		//	$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Surtido was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
