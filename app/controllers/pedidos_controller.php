<?php

class PedidosController extends AppController {

	var $name = 'Pedidos';

	function cliente_index() {	
	   if(! isset($this->passedArgs["sort"]))
        {
            $this->passedArgs["sort"]='id';
            $this->passedArgs["direction"]='desc';
        }
       
      // echo("asdf");
//       exit();
		$this->Pedido->recursive = 0;
		$this->set('pedidos', $this->paginate());
	}
    
    function cliente_check()
    {
        $error = false;
        //borramos los datos de la variables        
        unset($_SESSION["ok"]);
        unset($_SESSION["errror"]);
        unset($_SESSION["error"]);        
                                
        if(isset($_POST) && !empty($_POST) && ctype_digit($_POST["surtido"]))
        {
          $this->loadModel("Surtido");
          $Surtido=$this->Surtido->findById($_POST["surtido"]);
          if(!$Surtido)
          {
            $_SESSION["error"]=1;
            $error = true;
          }
          
          $this->loadModel("Calsado");
          $Calsad=$this->Calsado->findById($Surtido["Calsado"]["id"]);//proovedor
          
          
            $esmifoto=0;                
            foreach($Calsad["Foto"] as $fot) // verificar que sea mi foto
            {
                if($fot["id"]==$_POST["color"])
                {
                     $esmifoto=1;
                }
            }
            if(!$esmifoto) // si no es mi foto
            {
                $_SESSION["error"]=1;
                $error = true;
            }
          
            if($Surtido["Surtido"]["tipo"]=='cajas_surtidas')
            { 
                //que hayga mas de unno                
                $pares=0;                
                $v=$_POST["cajas"];
                if(ctype_digit($v) && $v>0)
                {$pares=$v;}
                else
                {$_SESSION["errror"]=1;
                $error = true;
                }
                $especificacion=array();                 
                $detalle=explode("-",$Surtido["Surtido"]["descripcion"]);
                $ie=0;
                for($i=$Surtido["Surtido"]["talla_inf"];$i<$Surtido["Surtido"]["talla_sup"]+1;$i++)
                {
                    $especificacion[$i]=$detalle[$ie];
                    $ie++; 
                }
                $bultos=$pares;// son las cajas
                $pares=$Surtido["Surtido"]["pares"];
            } 
                     
          if($Surtido["Surtido"]["tipo"]=='surtido_libre')
              {                
                    $tallasvalida=0; //valida si hay alguna talla valida
                    $especificacion=array();
                    $pares=0;
                    foreach($_POST["talla"] as $k=>$v)
                    {
                        if($k>=$Surtido["Surtido"]["talla_inf"] && $k<=$Surtido["Surtido"]["talla_sup"] && ctype_digit($v) && $v>0)
                        {             
                            $tallasvalida=1;
                            $especificacion[$k]=$v;
                            $pares=$pares+$v;
                        }
                    }      
                    if($pares<$Surtido["Surtido"]["pares"])
                    {
                        $_SESSION["errror"]=2;
                        $_SESSION["errror_min"]=$Surtido["Surtido"]["pares"];
                        $error = true;
                    }
                             
                    if(!$tallasvalida) // si esta vacio
                    {
                        $_SESSION["errror"]=1;
                        $error = true;
                    }
                    $bultos=ceil($pares/12);                    
                }  
                      
                if($Surtido["Surtido"]["oferta"]=='1' && $Surtido["Surtido"]["precio_sur_oferta"]) // si el calzado esta en oferta
                {
                    $p=$Surtido["Surtido"]["precio_sur_oferta"];
                    $articulo["descuento"]=$p;
                }
                else
                {
                    $p=$Surtido["Surtido"]["precio_sur"];
                }
                
                //si no hay error recion hace esto
                if($error == false)
                {
                    $p=$p + $p*$Calsad["Usuario"]["comision"]/100;                  
                    $this->loadModel("Pedido");
                    $this->Pedido->recursive=-1;
                    $pedido = $this->Pedido->find('first',array('conditions'=>array(
                    'confirmado'=>0,
                    'usuario_id'=>$this->Auth->user("id"),
                    'proveedor'=>$Calsad["Usuario"]["id"])));
                    
                    $taxx=Configure::read('tax'); $iva=0; $re=0;
                    $iva=$taxx["iva"];
                    $re=$taxx["re"];
                                    
                    if($pedido)
                    {
                        $pedido_id=$pedido["Pedido"]["id"];
                    }
                    else
                    {
                        $pedido=array();  
                        $this->Pedido->create();
                        $pedido["usuario_id"]=$this->Auth->user("id");
                        $pedido["confirmado"]=0;                
                        $pedido["re"]= $this->Auth->user("re")?1:0;
                        $pedido["iva"]= $this->Auth->user("iva")?1:0;
                        
                        $pedido["resave"]= $this->Auth->user("re")?$re:0;
                        $pedido["ivasave"]= $this->Auth->user("iva")?$iva:0;
                        
                        $pedido["tim"]=DboSource::expression('NOW()');
                        $pedido["proveedor"]=$Calsad["Usuario"]["id"];                
                        $this->Pedido->save($pedido);
                        $pedido_id = $this->Pedido->id;                
                    }                
                    $this->loadModel("Articulo");
                    $this->Articulo->create();                
                    $articulo["talla_inf"]=$Surtido["Surtido"]["talla_inf"];
                    $articulo["talla_sup"]=$Surtido["Surtido"]["talla_sup"];                
                    $articulo["comision"]=$Calsad["Usuario"]["comision"];
                    $articulo["surtido_id"]=$Surtido["Surtido"]["id"];                   
                    $articulo["pedido_id"]=$pedido_id;             
                    $articulo["foto_id"]=$_POST["color"];
                    $articulo["tipo"]=$Surtido["Surtido"]["tipo"];
                    $articulo["especificacion"]= json_encode($especificacion);              
                    $articulo["proveedor"]=$Calsad["Usuario"]["id"];                      
                    $articulo["cliente"]=$this->Auth->user('id');
                    $articulo["precio_unitario"]=$p;
                    $articulo["unidades"]=$pares;
                    $articulo["bultos"]=$bultos;
                    $articulo["tim"]=DboSource::expression('NOW()');                
                    if($this->Articulo->save($articulo))
                    {
                        $this->Articulo->saveField('serializado',serialize($articulo));
                        $_SESSION["ok"]=1;
                    }
                    else{
                        $_SESSION["ok"]=0;
                    }
                } 
                
                //controlamos todos los casos
                $mensaje = "";
                
                if( isset($_SESSION["ok"]) && $_SESSION["ok"]){
                    $mensaje = ___(utf8_encode("Este articulo ha sido añadido al pedido correctamente, cuando termine la compra vaya a Mis Pedidos para cursar su pedido. Gracias"),true);
                }else if(isset($_SESSION["ok"])){
                    $mensaje = ___(utf8_encode("Error"),true);
                }else if( isset($_SESSION["errror"]) && $_SESSION["errror"]==2 ){
                    $mensaje = ___("El minimo de pares para este surtido son ",true) . " " .$_SESSION["errror_min"];
                }else if( isset($_SESSION["errror"])){
                    $mensaje = ___("Faltan datos en su pedido",true);
                }
                
                $pedidos = $this->Pedido->query("select count(*) total from pedidos where confirmado=0 and usuario_id=".$this->Auth->user("id"));
                
                echo json_encode(array("mensaje" => $mensaje,"pedidos" => $pedidos[0][0]['total']));
                exit();
                
      }else{
        echo "<script>window.location.href='".header("location:".$_SERVER["HTTP_REFERER"])."'</script>";
        exit();
      }
    }
    
    function cliente_plus($id)
    {
        $id=$id-1;
        if(isset($_SESSION["cart"][$id]))
        {
            $_SESSION["cart"][$id]["cant"]=$_SESSION["cart"][$id]["cant"]+1;
        }
        $this->__recarcular();
        $this->redirect(array("action"=>'canasta'));
    }
        function cliente_minus($id)
    {
        $id=$id-1;
        if(isset($_SESSION["cart"][$id]) && $_SESSION["cart"][$id]["cant"]>1 )
        {
            $_SESSION["cart"][$id]["cant"]=$_SESSION["cart"][$id]["cant"]-1;
        }
        $this->__recarcular();        
        $this->redirect(array("action"=>'canasta'));
    }
//        function cliente_delete($id)
//    {
//        $pedido = $this->Pedido->findById($id);
//        print_r($pedido);
//        exit();
//        
//        
//        $this->redirect(array("action"=>'canasta'));
//    }
    
    function cliente_canasta()
    {  
       $this->layout='default';        
    }
    function __recarcular() 
    {
        $total=0;
        foreach ($_SESSION['cart'] as $compra)
        {
            $total=$total+$compra["cant"]*$compra["price"];
        }
        $_SESSION["total"]=$total;
        
    }
    function cliente_checkout()
    {
        $pedido=$this->Pedido->find("first",array('conditions'=>array('Pedido.id'=>$_POST["pedido_id"],'Pedido.proveedor'=>$_POST["proovedor"])));        
            if($pedido["Usuario"]["id"]==$this->Auth->user("id") &&  sizeof($pedido["Articulo"])>0)
            {
                $this->Pedido->id=$pedido["Pedido"]["id"];
                $this->Pedido->saveField('di_envio',$_POST["entrega"]);
                $this->Pedido->saveField('di_factura',$_POST["factura"]);
                $this->Pedido->saveField('confirmado','1');
                
                //Email para el admin
                $this->loadModel("Usuario");
                $this->Usuario->id=$this->Pedido->field("proveedor");
                $this->set("proveedor",$this->Usuario->read(null,$this->Pedido->field("proveedor")));
				$this->Email->to = Configure::read('admin-email');
        		$this->Email->subject ="SpanishWholesale - Nuevo Pedido";
                $this->Email->return = 'info@'.str_replace('www.', '',env('SERVER_NAME'));
        		$this->Email->from = 'SpanishWholeSale<info@'.str_replace('www.', '', env('SERVER_NAME')).'>';
        		$this->Email->template = 'nuevo_pedido_admin';
        		$this->Email->sendAs = 'html';
                $this->Email->delivery= 'mail';
        		$this->Email->send();
                
                //Email para el usuario
                $this->loadModel("Usuario");
                $this->Usuario->id=$this->Pedido->field("proveedor");
                $this->set("proveedor",$this->Usuario->read(null,$this->Pedido->field("proveedor")));
        		$this->Email->to = $this->Usuario->field("email");
        		$this->Email->subject ="SpanishWholesale - Nuevo Pedido";
                $this->Email->return = 'info@'.str_replace('www.', '',env('SERVER_NAME'));
        		$this->Email->from = 'SpanishWholeSale<info@'.str_replace('www.', '', env('SERVER_NAME')).'>';
        		$this->Email->template = 'nuevo_pedido_prov';
        		$this->Email->sendAs = 'html';
                $this->Email->delivery= 'mail';
        		$this->Email->send();
				
                $this->Session->setFlash(___(utf8_encode("Pedido realizado correctamente, en breve recibirá la confirmación de su reserva. Gracias."),1));
            }
            else
                $this->Session->setFlash(___("Error"));
		$this->redirect(array('action' => 'canasta','controller'=>'pedidos'));
	}
    
    function cliente_paypal($id=null)
    {
        ///////////!!!! validar datos!!!
        
       App::import('Vendor','/paypal/paypal');/////////////////importar paypal
       $paypal = new paypal();
                
         if(! isset($_REQUEST['token'])) {
           $pedido = $this->Pedido->read(null, $id);/////////////datos del pedido
		   $serverName = $_SERVER['SERVER_NAME'];
		   $serverPort = $_SERVER['SERVER_PORT'];
		   $url=dirname('http://'.$serverName.':'.$serverPort.$_SERVER['REQUEST_URI']);
		   $currencyCodeType='EUR';///////// SE PUEDE CAMBIAR A DOLARES
		   $paymentType='Sale';  //////otros tipos de pago
  
  
    $impuestos=$pedido["Pedido"]["iva"]+$pedido["Pedido"]["re"];   
    $i=0;
    App::import('Model', 'Calsado');
    $MCalsado = new Calsado();
    $total=0;
    $nvpstr="";
    
    foreach($pedido["Articulo"] as $articulo)
    {
       $Calsado = $MCalsado->find('first',array('conditions'=>array('Surtido.id'=>$articulo['surtido_id']),'joins'=>array(
                   array('table' => 'surtidos',
                    'alias' => 'Surtido',
                    'type' => 'RIGHT',
                    'conditions' => array('Calsado.id =Surtido.calsado_id')),),));
                    
      $precio_art=$articulo["subtotal"]/$articulo["cantidad"];
      $nvpstr.="&L_NAME$i=".urlencode($Calsado['Calsado']['title'])."&L_AMT$i=".$precio_art."&L_QTY$i=".$articulo["cantidad"];
      $total=$total+($precio_art*$articulo["cantidad"]);
      $i++;
    }
    $totalimpuestos=($total*$impuestos)/100;    
    $itemamt =$total;  // total solo items sin impuestos
    $amt = $total+$totalimpuestos;  // total mas impuestos y opciones
    $maxamt= $amt;   // se refiere cuando hay opciones lo maximo que puede llegar
    

		   $returnURL =urlencode($url.'/?currencyCodeType='.$currencyCodeType.'&paymentType='.$paymentType);
		   $cancelURL =urlencode("$url/?paymentType=$paymentType" );
           $nvpstr.= "&MAXAMT=".(string)$maxamt."&AMT=".(string)$amt."&ITEMAMT=".(string)$itemamt."&TAXAMT=$totalimpuestos"."&ReturnUrl=".$returnURL."&CANCELURL=".$cancelURL ."&CURRENCYCODE=".$currencyCodeType."&PAYMENTACTION=".$paymentType;
           
         // echo $nvpstr;
//           exit();
		   $resArray=$paypal->hash_call("SetExpressCheckout",$nvpstr);
		   $_SESSION['reshash']=$resArray;

		   $ack = strtoupper($resArray["ACK"]);

		   if($ack=="SUCCESS"){
					// Redirect to paypal.com here
					$token = urldecode($resArray["TOKEN"]);
					$payPalURL = PAYPAL_URL.$token;
					header("Location: ".$payPalURL);
				  } else  {
				    
				    $this->Session->setFlash(___('Existe un error #1', true));
        	        $this->redirect(array('controller'=>'usuarios','action'=>'msg'));
                    
					}
                } else {                    
                    
                        $token =urlencode( $_REQUEST['token']);
                        $nvpstr="&TOKEN=".$token;
                        
                        
                        /* Make the API call and store the results in an array.  If the
                        call was a success, show the authorization details, and provide
                        an action to complete the payment.  If failed, show the error
                        */
                        $resArray=$paypal->hash_call("GetExpressCheckoutDetails",$nvpstr);
                        $_SESSION['reshash']=$resArray;
                        $ack = strtoupper($resArray["ACK"]);
                        
                        if($ack == 'SUCCESS' || $ack == 'SUCCESSWITHWARNING'){
                        //	require_once "GetExpressCheckoutDetails.php";
                        } else  {
                        
                        $this->Session->setFlash(___('Exite un error #2', true));
                        $this->redirect(array('controller'=>'usuarios','action'=>'msg'));
}
                }

    $this->layout='default';    
    }
    
    function cliente_expresscheckoutpayment()
    {
    
        App::import('Vendor','paypal\Paypal');/////////////////importar paypal
        $paypal = new paypal();
    
        ini_set('session.bug_compat_42',0);
        ini_set('session.bug_compat_warn',0);
        
        /* Gather the information to make the final call to
           finalize the PayPal payment.  The variable nvpstr
           holds the name value pairs
           */
        $token =urlencode( $_SESSION['token']);
        $paymentAmount =urlencode ($_SESSION['TotalAmount']);
        $paymentType = urlencode($_SESSION['paymentType']);
        $currCodeType = urlencode($_SESSION['currCodeType']);
        $payerID = urlencode($_SESSION['payer_id']);
        $serverName = urlencode($_SERVER['SERVER_NAME']);
        
        $nvpstr='&TOKEN='.$token.'&PAYERID='.$payerID.'&PAYMENTACTION='.$paymentType.'&AMT='.$paymentAmount.'&CURRENCYCODE='.$currCodeType.'&IPADDRESS='.$serverName ;
        
        
        
         /* Make the call to PayPal to finalize payment
            If an error occured, show the resulting errors
            */
        $resArray=$paypal->hash_call("DoExpressCheckoutPayment",$nvpstr);
        
        /* Display the API response back to the browser.
           If the response from PayPal was a success, display the response parameters'
           If the response was an error, display the errors received using APIError.php.
           */
        $ack = strtoupper($resArray["ACK"]);
        
     //   print_r($ack);
        
        if($ack != 'SUCCESS' && $ack != 'SUCCESSWITHWARNING'){
            $this->Session->setFlash(___('El code ya fue usado o exite un error #3', true));
        	$this->redirect(array('controller'=>'usuarios','action'=>'msg'));
        }
        $_SESSION['token']='';////////////le quito el token
        $this->layout='default';
         
    }
    
    
//	function cliente_pedido($id = null) {
//		if (!$id) {
//			$this->Session->setFlash(__('Invalid pedido', true));
//			$this->redirect(array('action' => 'index'));
//		}
//        
//        $pedido=$this->Pedido->find('first',array('conditions'=>array('Pedido.id'=>$id,'Pedido.usuario_id'=>$this->Auth->user('id')),
//        ));
//		$this->set('pedido', $pedido);
//        $this->layout="default";
//	}
    
    function admin_pedido($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid pedido', true));
			$this->redirect(array('action' => 'index'));
		}
        
        $pedido=$this->Pedido->find('first',array('conditions'=>array('Pedido.id'=>$id),
        ));
		$this->set('pedido', $pedido);

	}
    
//
//	function add() {
//		if (!empty($this->data)) {
//			$this->Pedido->create();
//			if ($this->Pedido->save($this->data)) {
//				$this->Session->setFlash(__('The pedido has been saved', true));
//				$this->redirect(array('action' => 'index'));
//			} else {
//				$this->Session->setFlash(__('The pedido could not be saved. Please, try again.', true));
//			}
//		}
//		$usuarios = $this->Pedido->Usuario->find('list');
//		$this->set(compact('usuarios'));
//	}
//
//	function edit($id = null) {
//		if (!$id && empty($this->data)) {
//			$this->Session->setFlash(__('Invalid pedido', true));
//			$this->redirect(array('action' => 'index'));
//		}
//		if (!empty($this->data)) {
//			if ($this->Pedido->save($this->data)) {
//				$this->Session->setFlash(__('The pedido has been saved', true));
//				$this->redirect(array('action' => 'index'));
//			} else {
//				$this->Session->setFlash(__('The pedido could not be saved. Please, try again.', true));
//			}
//		}
//		if (empty($this->data)) {
//			$this->data = $this->Pedido->read(null, $id);
//		}
//		$usuarios = $this->Pedido->Usuario->find('list');
//		$this->set(compact('usuarios'));
//	}
//
//	function delete($id = null) {
//		if (!$id) {
//			$this->Session->setFlash(__('Invalid id for pedido', true));
//			$this->redirect(array('action'=>'index'));
//		}
//		if ($this->Pedido->delete($id)) {
//			$this->Session->setFlash(__('Pedido deleted', true));
//			$this->redirect(array('action'=>'index'));
//		}
//		$this->Session->setFlash(__('Pedido was not deleted', true));
//		$this->redirect(array('action' => 'index'));
//	}
	function admin_index() {
	   
		if(! isset($this->passedArgs["sort"]))
        {
            $this->passedArgs["sort"]='id';
            $this->passedArgs["direction"]='desc';
        }
        
        $this->Pedido->recursive = 0;
		$this->set('pedidos', $this->paginate(null,array('confirmado'=>'1')));
        
        if(isset($_POST["form"]) && $_POST["form"]=='1')
        {
            if(isset($_POST["cliente_id"]) && $_POST["cliente_id"])
            {
              $this->set('pedidos', $this->Pedido->query("Select * from `pedidos` Pedido, usuarios Usuario where 
Pedido.`usuario_id`=Usuario.id and Pedido.confirmado='1' and Usuario.`id`={$_POST["cliente_id"]}"));  
            }
            if(isset($_POST["cliente"]) && $_POST["cliente"])
            {
              $this->set('pedidos', $this->Pedido->query("Select * from `pedidos` Pedido, usuarios Usuario where 
Pedido.`usuario_id`=Usuario.id and Pedido.confirmado='1' and Usuario.`title` like '%{$_POST["cliente"]}%'"));  
            }
            
            if(isset($_POST["cliente_id"]) && isset($_POST["cliente"]) && $_POST["cliente_id"] && $_POST["cliente"] )
            {
              $this->set('pedidos', $this->Pedido->query("Select * from `pedidos` Pedido, usuarios Usuario where 
Pedido.`usuario_id`=Usuario.id and Pedido.confirmado='1' and Usuario.`id`={$_POST["cliente_id"]} and Usuario.`title` like '%{$_POST["cliente"]}%'"));  
            }
            
        }
        if(isset($_POST["form"]) && $_POST["form"]=='3')
        {
            if(isset($_POST["pedido"]) && $_POST["pedido"])
            {
              $this->set('pedidos', $this->Pedido->query("Select * from `pedidos` Pedido, usuarios Usuario where 
Pedido.`usuario_id`=Usuario.id and Pedido.confirmado='1' and Pedido.`id`={$_POST["pedido"]}"));  
            }
            
        }
        if(isset($_POST["form"]) && $_POST["form"]=='2')
        {           
           $sql="Select * from `pedidos` Pedido, usuarios Usuario where 
Pedido.`usuario_id`=Usuario.id ";
           
            if(isset($_POST["mes"]) && $_POST["mes"])
            {
              $sql.=" and MONTH(Pedido.`tim`)={$_POST["mes"]} ";
            }
            if(isset($_POST["ano"]) && $_POST["ano"])
            {
              $sql.=" and YEAR(Pedido.`tim`)={$_POST["ano"]} ";
            }
            if(isset($_POST["confimado"]) && $_POST["confimado"])
            {
             $var=1;
             if(isset($_POST["confimado"]) && $_POST["confimado"]=='n')
             $var=0;   
              $sql.=" and Pedido.`estado`=$var ";
            }
            
            if(isset($_POST["enviado"]) && $_POST["enviado"])
            {
             $var=1;
             if(isset($_POST["enviado"]) && $_POST["enviado"]=='n')
             $var=0;   
              $sql.=" and Pedido.`enviado`=$var ";
            }
            
           if(isset($_POST["anulado"]) && $_POST["anulado"])
            {
             $var=1;
             if(isset($_POST["anulado"]) && $_POST["anulado"]=='n')
             $var=0;   
              $sql.=" and Pedido.`anulado`=$var ";
              
             } 
           if(isset($_POST["cobrado"]) && $_POST["cobrado"])
            {
             $var=1;
             if(isset($_POST["cobrado"]) && $_POST["cobrado"]=='n')
             $var=0;   
              $sql.=" and Pedido.`pagado`=$var ";
              }
            
            if(isset($_POST["data"]["proveedor"]) && $_POST["data"]["proveedor"])
            {
               
              $sql.="  and Pedido.`proveedor`={$_POST["data"]["proveedor"]}";
            }   
            
            $sql.=" and Pedido.confirmado='1'"; 
              
         $this->set('pedidos', $this->Pedido->query($sql));
         }
        
        $this->loadModel("Usuario");
        $this->set('proveedores',$this->Usuario->find("list",array('conditions'=>array('rol'=>'proveedor')))); 
        
	}
    
    function proveedor_index() {
        if(!isset($this->passedArgs["sort"]))
       {
        $this->redirect(array('action'=>'index','sort'=>'id','direction'=>'desc'));
       }       
	   
		$miid=$this->Auth->user("id");
        $this->Pedido->recursive = 0;
		$this->set('pedidos', $this->paginate(null,array('confirmado'=>'1', 'enviado'=>'0', 'proveedor'=>$miid)));
        
        
        if(isset($_POST["form"]) && $_POST["form"]=='1')
        {
            if(isset($_POST["cliente_id"]) && $_POST["cliente_id"])
            {
              $this->set('pedidos', $this->Pedido->query("Select * from `pedidos` Pedido, usuarios Usuario where 
Pedido.`usuario_id`=Usuario.id and Pedido.confirmado='1' and Pedido.proveedor=$miid and Usuario.`id`={$_POST["cliente_id"]}"));  
            }
            if(isset($_POST["cliente"]) && $_POST["cliente"])
            {
              $this->set('pedidos', $this->Pedido->query("Select * from `pedidos` Pedido, usuarios Usuario where 
Pedido.`usuario_id`=Usuario.id and Pedido.confirmado='1' and Pedido.proveedor=$miid and Usuario.`title` like '%{$_POST["cliente"]}%'"));  
            }
            
            if(isset($_POST["cliente_id"]) && isset($_POST["cliente"]) && $_POST["cliente_id"] && $_POST["cliente"] )
            {
              $this->set('pedidos', $this->Pedido->query("Select * from `pedidos` Pedido, usuarios Usuario where 
Pedido.`usuario_id`=Usuario.id and Pedido.confirmado='1' and Pedido.proveedor=$miid and Usuario.`id`={$_POST["cliente_id"]} and Usuario.`title` like '%{$_POST["cliente"]}%'"));  
            }
            
        }
        
        if(isset($_POST["form"]) && $_POST["form"]=='3')
        {
            if(isset($_POST["pedido"]) && $_POST["pedido"])
            {
              $this->set('pedidos', $this->Pedido->query("Select * from `pedidos` Pedido, usuarios Usuario where 
Pedido.`usuario_id`=Usuario.id and Pedido.confirmado='1' and Pedido.proveedor=$miid and Pedido.`id`={$_POST["pedido"]}"));  
            }
            
        }
        
        if(isset($_POST["form"]) && $_POST["form"]=='2')
        {           
           $sql="Select * from `pedidos` Pedido, usuarios Usuario where 
Pedido.`usuario_id`=Usuario.id ";
           
            if(isset($_POST["mes"]) && $_POST["mes"])
            {
              $sql.=" and MONTH(Pedido.`tim`)={$_POST["mes"]} ";
            }
            if(isset($_POST["ano"]) && $_POST["ano"])
            {
              $sql.=" and YEAR(Pedido.`tim`)={$_POST["ano"]} ";
            }
            if(isset($_POST["confimado"]) && $_POST["confimado"])
            {
             $var=1;
             if(isset($_POST["confimado"]) && $_POST["confimado"]=='n')
             $var=0;   
              $sql.=" and Pedido.`estado`=$var ";
            }
            
            if(isset($_POST["enviado"]) && $_POST["enviado"])
            {
             $var=1;
             if(isset($_POST["enviado"]) && $_POST["enviado"]=='n')
             $var=0;   
              $sql.=" and Pedido.`enviado`=$var ";
            }
            
           if(isset($_POST["anulado"]) && $_POST["anulado"])
            {
             $var=1;
             if(isset($_POST["anulado"]) && $_POST["anulado"]=='n')
             $var=0;   
              $sql.=" and Pedido.`anulado`=$var ";
              
             } 
           if(isset($_POST["cobrado"]) && $_POST["cobrado"])
            {
             $var=1;
             if(isset($_POST["cobrado"]) && $_POST["cobrado"]=='n')
             $var=0;   
              $sql.=" and Pedido.`pagado`=$var ";
              }
              
              $sql.=" and Pedido.confirmado='1' and Pedido.`proveedor`={$miid}";
              
         $this->set('pedidos', $this->Pedido->query($sql));
         }
        
        $this->loadModel("Usuario");
        $this->set('proveedores',$this->Usuario->find("list",array('conditions'=>array('rol'=>'proveedor','id'=>$miid)))); 
        
	}
    
    function proveedor_lista() {
		$miid=$this->Auth->user("id");
        $this->Pedido->recursive = 0;
		$this->set('pedidos', $this->paginate(null,array('confirmado'=>'1','enviado'=>'1','proveedor'=>$miid)));
        
        
        if(isset($_POST["form"]) && $_POST["form"]=='1')
        {
            if(isset($_POST["cliente_id"]) && $_POST["cliente_id"])
            {
              $this->set('pedidos', $this->Pedido->query("Select * from `pedidos` Pedido, usuarios Usuario where 
Pedido.`usuario_id`=Usuario.id and Pedido.confirmado='1' and Pedido.proveedor=$miid and Usuario.`id`={$_POST["cliente_id"]}"));  
            }
            if(isset($_POST["cliente"]) && $_POST["cliente"])
            {
              $this->set('pedidos', $this->Pedido->query("Select * from `pedidos` Pedido, usuarios Usuario where 
Pedido.`usuario_id`=Usuario.id and Pedido.confirmado='1' and Pedido.proveedor=$miid and Usuario.`title` like '%{$_POST["cliente"]}%'"));  
            }
            
            if(isset($_POST["cliente_id"]) && isset($_POST["cliente"]) && $_POST["cliente_id"] && $_POST["cliente"] )
            {
              $this->set('pedidos', $this->Pedido->query("Select * from `pedidos` Pedido, usuarios Usuario where 
Pedido.`usuario_id`=Usuario.id and Pedido.confirmado='1' and Pedido.proveedor=$miid and Usuario.`id`={$_POST["cliente_id"]} and Usuario.`title` like '%{$_POST["cliente"]}%'"));  
            }
            
        }
        
        if(isset($_POST["form"]) && $_POST["form"]=='3')
        {
            if(isset($_POST["pedido"]) && $_POST["pedido"])
            {
              $this->set('pedidos', $this->Pedido->query("Select * from `pedidos` Pedido, usuarios Usuario where 
Pedido.`usuario_id`=Usuario.id and Pedido.confirmado='1' and Pedido.proveedor=$miid and Pedido.`id`={$_POST["pedido"]}"));  
            }
            
        }
        
        if(isset($_POST["form"]) && $_POST["form"]=='2')
        {           
           $sql="Select * from `pedidos` Pedido, usuarios Usuario where 
Pedido.`usuario_id`=Usuario.id ";
           
            if(isset($_POST["mes"]) && $_POST["mes"])
            {
              $sql.=" and MONTH(Pedido.`tim`)={$_POST["mes"]} ";
            }
            if(isset($_POST["ano"]) && $_POST["ano"])
            {
              $sql.=" and YEAR(Pedido.`tim`)={$_POST["ano"]} ";
            }
            if(isset($_POST["confimado"]) && $_POST["confimado"])
            {
             $var=1;
             if(isset($_POST["confimado"]) && $_POST["confimado"]=='n')
             $var=0;   
              $sql.=" and Pedido.`estado`=$var ";
            }
            
            if(isset($_POST["enviado"]) && $_POST["enviado"])
            {
             $var=1;
             if(isset($_POST["enviado"]) && $_POST["enviado"]=='n')
             $var=0;   
              $sql.=" and Pedido.`enviado`=$var ";
            }
            
           if(isset($_POST["anulado"]) && $_POST["anulado"])
            {
             $var=1;
             if(isset($_POST["anulado"]) && $_POST["anulado"]=='n')
             $var=0;   
              $sql.=" and Pedido.`anulado`=$var ";
              
             } 
           if(isset($_POST["cobrado"]) && $_POST["cobrado"])
            {
             $var=1;
             if(isset($_POST["cobrado"]) && $_POST["cobrado"]=='n')
             $var=0;   
              $sql.=" and Pedido.`pagado`=$var ";
              }
              
              $sql.=" and Pedido.confirmado='1' and Pedido.`proveedor`={$miid}";
              
         $this->set('pedidos', $this->Pedido->query($sql));
         }
        
        $this->loadModel("Usuario");
        $this->set('proveedores',$this->Usuario->find("list",array('conditions'=>array('rol'=>'proveedor','id'=>$miid)))); 
        
	}    
    
    function admin_incomplete() {
		$this->Pedido->recursive = 0;
		$this->set('pedidos', $this->paginate(null,array('confirmado'=>'2')));
       // $this->render('admin_index');
	}
   
	function admin_edit($id = null) {
	 	
        if ($this->data) {
          
            $this->Pedido->id=$this->data["Pedido"]["id"];
            $taxx=Configure::read('tax'); $iva=$taxx["iva"]; $re=$taxx["re"];
            $this->Pedido->saveField('iva',$this->data["Pedido"]["iva"]);
            $this->Pedido->saveField('re',$this->data["Pedido"]["re"]);
            $this->Pedido->saveField('portes',$this->data["Pedido"]["portes"]);            
            $this->Pedido->saveField('resave',$re);
            $this->Pedido->saveField('ivasave',$iva);
            
            $this->Pedido->saveField('di_envio',$_POST["di_envio"]);
            $this->Pedido->saveField('di_factura',$_POST["di_factura"]);
             
            
            $this->loadModel("Articulo");
            
            foreach($this->data["Pedido"]["Articulo"] as $k=>$v)
            {
                $this->Articulo->id=$v["id"];
                $this->Articulo->saveField('precio_unitario',$v["precio_unitario"]);
                
                if(isset($v["unidades"]))
                $this->Articulo->saveField('unidades',$v["unidades"]);
                
                if(isset($v["bultos"]))
                $this->Articulo->saveField('bultos',$v["bultos"]);
                
            }           
		}

		$this->data = $this->Pedido->read(null, $id);
        
        $this->loadModel("Usuario");
        $transportistas = $this->Usuario->find('list',array('conditions'=> array('rol'=>'transporte'))) ;
        $this->set(compact('transportistas'));
        
	}
    	function proveedor_edit($id = null) {
	 	
        if ($this->data) {
          
            $this->Pedido->id=$this->data["Pedido"]["id"];
            $taxx=Configure::read('tax'); $iva=$taxx["iva"]; $re=$taxx["re"];
            $this->Pedido->saveField('iva',$this->data["Pedido"]["iva"]);
            $this->Pedido->saveField('re',$this->data["Pedido"]["re"]);
            $this->Pedido->saveField('portes',$this->data["Pedido"]["portes"]);            
            $this->Pedido->saveField('resave',$re);
            $this->Pedido->saveField('ivasave',$iva);
            
            $_POST["di_envio"] = isset($_POST["di_envio"]) ? $_POST["di_envio"] : NULL;
            $_POST["di_factura"] = isset($_POST["di_factura"]) ? $_POST["di_factura"] : NULL;
            $this->Pedido->saveField('di_envio',$_POST["di_envio"]);
            $this->Pedido->saveField('di_factura',$_POST["di_factura"]);
            
            
            $this->loadModel("Articulo");
            
            foreach($this->data["Pedido"]["Articulo"] as $k=>$v)
            {
                $this->Articulo->id=$v["id"];
                $this->Articulo->saveField('precio_unitario',$v["precio_unitario"]);
                
                if(isset($v["unidades"]))
                $this->Articulo->saveField('unidades',$v["unidades"]);
                
                if(isset($v["bultos"]))
                $this->Articulo->saveField('bultos',$v["bultos"]);
                
            }           
		}

		$this->data = $this->Pedido->read(null, $id);
        $this->Pedido->id=$id;
        
        $this->Pedido->saveField('revisado',1);
        
        $this->loadModel("Usuario");
        $transportistas = $this->Usuario->find('list',array('conditions'=> array('rol'=>'transporte'))) ;
        $this->set(compact('transportistas'));
        
	}
    
	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for pedido', true));
			$this->redirect(array('action'=>'index'));
		}
		    $this->Pedido->id=$id;
			$this->Pedido->saveField('confirmado',2);
			$this->Session->setFlash(___('Pedido borrado', true));
			$this->redirect(array('action'=>'index'));

	}
    
    	function proveedor_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for pedido', true));
			$this->redirect(array('action'=>'index'));
		}
		    $this->Pedido->id=$id;
			$this->Pedido->saveField('confirmado',2);
			$this->Session->setFlash(___('Pedido borrado', true));
			$this->redirect(array('action'=>'index'));

	}
    
    
    	function admin_undelete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for pedido', true));
			$this->redirect(array('action'=>'index'));
		}
		    $this->Pedido->id=$id;
			$this->Pedido->saveField('confirmado',1);
			$this->Session->setFlash(___('Pedido '.$id.' recuperado', true));
			$this->redirect(array('action'=>'index'));

	}
    
        	function proveedor_undelete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for pedido', true));
			$this->redirect(array('action'=>'index'));
		}
		    $this->Pedido->id=$id;
			$this->Pedido->saveField('confirmado',1);
			$this->Session->setFlash(___('Pedido '.$id.' recuperado', true));
			$this->redirect(array('action'=>'index'));

	}
    
    
    function cliente_view($id = null) {
        if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid articulo', true));
			$this->redirect(array('action' => 'index'));
		}
		if (empty($this->data)) 
        {
			$this->data = $this->Pedido->read(null, $id);
                     
           // $this->Articulo->Pedido->Usuario->recursive=-1;
         //   $this->data["Cliente"]=$this->Articulo->Pedido->Usuario->find('first',array('conditions'=>array('Usuario.id'=> $this->data["Pedido"]["usuario_id"])));
//            
//            pr( $this->data);
//            exit();
            
        }
            
		//$surtidos = $this->Articulo->Surtido->find('list');
		//$pedidos = $this->Articulo->Pedido->find('list');
	//	$this->set(compact('surtidos', 'pedidos'));
      	$this->layout='default';
                
	}
    /** *********************************************************************************************************************************************************************/
    
        function admin_mensajeobserva($id)
    {        
        $this->Pedido->id=$id;
        $this->Pedido->saveField('estado',$_POST["confirmado"]);
        
        if(isset($_POST["texto"]) && $_POST["texto"]){
        App::import('Sanitize');        
        $mesaje["Mensaje"]["mensaje"]=Sanitize::clean($_POST["texto"], array('encode' => false,'remove_html' => array('remove'=>true),'escape'=>false,'carriage'=>false));
        $mesaje["Mensaje"]["tim"]= DboSource::expression('NOW()');
        $mesaje["Mensaje"]["tipo_mensaje"]= 'observa';
        $mesaje["Mensaje"]["pedido_id"]= $this->data["Pedido"]["id"];
        $this->Pedido->Mensaje->save($mesaje);
        }
        if(isset($_POST["confirmado"]) && $_POST["confirmado"]=='1')
        {
             $total=$this->Pedido->calcularTotal($id);
             $pedido = $this->Pedido->read();
             
             $this->loadModel("Usuario");
             $this->Usuario->id=$pedido["Pedido"]["proveedor"];
             $this->Usuario->recursive=-1;
             $provedor=$this->Usuario->read();            
             
             
             $this->set('date',date('d/m/Y'));          
             $this->set('pedido',$pedido);
             $this->set('proveedor',$provedor);
             $this->set('total',$total);
             $this->set('serializado',unserialize(base64_decode($provedor["Usuario"]["serializado"])));
             /*cosa de lang*/
             $lang="eng_";
             if($pedido["Usuario"]["lang"]=='esp')
             $lang="";
             $this->Email->to = $pedido["Usuario"]["email"];
		 	 $this->Email->subject ="SpanishWholesale - Pedido confirmado";
             $this->Email->return = 'info@'.str_replace('www.', '',env('SERVER_NAME'));
        	 $this->Email->from = 'SpanishWholeSale<info@'.str_replace('www.', '', env('SERVER_NAME')).'>';
        	 $this->Email->template = $lang.'pedido_confirmado';
        	 $this->Email->sendAs = 'html';
             $this->Email->delivery= 'mail';
        	 $this->Email->send();
            
        }
        $this->Session->setFlash(___(utf8_encode("Se guardaron los cambios correctamente"),1));  
        $this->redirect(array('action'=>'edit',$this->data["Pedido"]["id"]));        
    }
    
        function admin_mensajeesperando($id)
    {        
        $this->Pedido->id=$id;
        $this->Pedido->saveField('esperando_mercancia',$_POST["confirmado"]);
        App::import('Sanitize');     
        if(isset($_POST["texto"]) && $_POST["texto"]){   
        $mesaje["Mensaje"]["mensaje"]=Sanitize::clean($_POST["texto"], array('encode' => false,'remove_html' => array('remove'=>true),'escape'=>false,'carriage'=>false));
        $mesaje["Mensaje"]["tim"]= DboSource::expression('NOW()');
        $mesaje["Mensaje"]["tipo_mensaje"]= 'esperando';
        $mesaje["Mensaje"]["pedido_id"]= $this->data["Pedido"]["id"];
        
        if(isset($_POST["confirmado"]) && $_POST["confirmado"]=='1')
        {
             $total=$this->Pedido->calcularTotal($id);
             $pedido = $this->Pedido->read();
             $this->loadModel("Usuario");
             $this->Usuario->id=$pedido["Pedido"]["proveedor"];
             $this->Usuario->recursive=-1;
             $provedor=$this->Usuario->read();
            
             $this->set('pedido',$pedido);
             $this->set('proveedor',$provedor);
             $this->set('total',$total);
             $this->set('serializado',unserialize(base64_decode($provedor["Usuario"]["serializado"])));
             /*cosa de lang*/ 
             $lang="eng_";
             if($pedido["Usuario"]["lang"]=='esp')
             $lang="";             
             $this->Email->to = $pedido["Usuario"]["email"];
		 	 $this->Email->subject =___("SpanishWholesale - Pedido esperando",1);
             $this->Email->return = 'info@'.str_replace('www.', '',env('SERVER_NAME'));
        	 $this->Email->from = 'SpanishWholeSale<info@'.str_replace('www.', '', env('SERVER_NAME')).'>';
        	 $this->Email->template = $lang.'pedido_esperando';
        	 $this->Email->sendAs = 'html';
             $this->Email->delivery= 'mail';
        	 $this->Email->send();
        }
        $this->Pedido->Mensaje->save($mesaje);}
        $this->Session->setFlash(___(utf8_encode("Se guardaron los cambios correctamente"),1));  
        $this->redirect(array('action'=>'edit',$this->data["Pedido"]["id"]));        
    }
            function admin_enviado($id)
    {        
        $this->Pedido->id=$id;
        $this->Pedido->saveField('enviado',$_POST["confirmado"]);
        $this->Pedido->saveField('empresa_transporte',$_POST["empresa_transporte"]);
        $this->Pedido->saveField('fecha_salida',$_POST["fecha_salida"]);
        
        if(isset($_POST["confirmado"]) && $_POST["confirmado"]=='1')
        {
             $total=$this->Pedido->calcularTotal($id);
             $pedido = $this->Pedido->read();
             $this->loadModel("Usuario");
             $this->Usuario->id=$pedido["Pedido"]["proveedor"];
             $this->Usuario->recursive=-1;
             $provedor=$this->Usuario->read();
             $this->set('date',$_POST["fecha_salida"]);          
             $this->set('pedido',$pedido);
             $this->set('proveedor',$provedor);
             $this->set('total',$total);
             $this->set('serializado',unserialize(base64_decode($provedor["Usuario"]["serializado"])));
             $lang="eng_";
             if($pedido["Usuario"]["lang"]=='esp')
             $lang="";            
             $this->Email->to = $pedido["Usuario"]["email"];
		 	 $this->Email->subject =___("SpanishWholesale - Pedido enviado",1);
             $this->Email->return = 'info@'.str_replace('www.', '',env('SERVER_NAME'));
        	 $this->Email->from = 'SpanishWholeSale<info@'.str_replace('www.', '', env('SERVER_NAME')).'>';
        	 $this->Email->template = $lang.'pedido_enviado';
        	 $this->Email->sendAs = 'html';
             $this->Email->delivery= 'mail';
        	 $this->Email->send();
        }
         $this->Session->setFlash(___(utf8_encode("Se guardaron los cambios correctamente"),1));  
        $this->redirect(array('action'=>'edit',$this->data["Pedido"]["id"]));        
    }
    
            function admin_anulado($id)
    {        
        $this->Pedido->id=$id;
        $this->Pedido->saveField('anulado',$_POST["confirmado"]);
        $this->Pedido->saveField('causa_anulacion',$_POST["causa_anulacion"]);
        
       if(isset($_POST["confirmado"]) && $_POST["confirmado"]=='1')
        {
             
             $total=$this->Pedido->calcularTotal($id);
             $pedido = $this->Pedido->read();
             $this->loadModel("Usuario");
             $this->Usuario->id=$pedido["Pedido"]["proveedor"];
             $this->Usuario->recursive=-1;
             $provedor=$this->Usuario->read();
               
             $this->set('pedido',$pedido);
             $this->set('proveedor',$provedor);
             $this->set('total',$total);
             $this->set('serializado',unserialize(base64_decode($provedor["Usuario"]["serializado"])));
             /*cosa de lang*/ 
             $lang="eng_";
             if($pedido["Usuario"]["lang"]=='esp')
             $lang="";                         
             $this->Email->to = $pedido["Usuario"]["email"];
		 	 $this->Email->subject = ___("SpanishWholesale - Pedido anulado",1);
             $this->Email->return = 'info@'.str_replace('www.', '',env('SERVER_NAME'));
        	 $this->Email->from = 'SpanishWholeSale<info@'.str_replace('www.', '', env('SERVER_NAME')).'>';
        	 $this->Email->template = $lang.'pedido_anulado';
        	 $this->Email->sendAs = 'html';
             $this->Email->delivery= 'mail';
        	 $this->Email->send();
        }
        $this->Session->setFlash(___(utf8_encode("Se guardaron los cambios correctamente"),1));  
        $this->redirect(array('action'=>'edit',$this->data["Pedido"]["id"]));        
    }
    
            function admin_existencias($id,$cheked)
    {        
        $this->Pedido->id=$id;
        $existe = $this->Pedido->field('existencias');
        
        if($existe && $cheked)
        $this->Pedido->saveField('existencias',0);
        else
        $this->Pedido->saveField('existencias',1);
        exit();
        //header("location:".$_SERVER["HTTP_REFERER"]);exit();
    }
    
    
        /** *********************************************************************************************************************************************************************/
    function admin_pedidopagado($id,$est)
    {     
        $this->Pedido->id=$id;
        $this->Pedido->saveField('pagado',$est);
        exit();
    }
      function proveedor_pedidopagado($id,$est)
    {     
        $this->Pedido->id=$id;
        $this->Pedido->saveField('pagado',$est);
        exit();
    }
        function proveedor_mensajeobserva($id)
    {        
        $this->Pedido->id=$id;
        $this->Pedido->saveField('estado',$_POST["confirmado"]);
        
        
        if(isset($_POST["texto"]) && $_POST["texto"]){
        App::import('Sanitize');        
        $mesaje["Mensaje"]["mensaje"]=Sanitize::clean($_POST["texto"], array('encode' => false,'remove_html' => array('remove'=>true),'escape'=>false,'carriage'=>false));
        $mesaje["Mensaje"]["tim"]= DboSource::expression('NOW()');
        $mesaje["Mensaje"]["tipo_mensaje"]= 'observa';
        $mesaje["Mensaje"]["pedido_id"]= $this->data["Pedido"]["id"];
        $this->Pedido->Mensaje->save($mesaje);
        }
        if(isset($_POST["confirmado"]) && $_POST["confirmado"]=='1')
        {
             $total=$this->Pedido->calcularTotal($id);
             $pedido = $this->Pedido->read();
             
             $this->loadModel("Usuario");
             $this->Usuario->id=$pedido["Pedido"]["proveedor"];
             $this->Usuario->recursive=-1;
             $provedor=$this->Usuario->read();            
             
             
             $this->set('date',date('d/m/Y'));          
             $this->set('pedido',$pedido);
             $this->set('proveedor',$provedor);
             $this->set('total',$total);
             $this->set('serializado',unserialize(base64_decode($provedor["Usuario"]["serializado"])));
             /*cosa de lang*/
             $lang="eng_";
             if($pedido["Usuario"]["lang"]=='esp')
             $lang="";
             $this->Email->to = $pedido["Usuario"]["email"];
		 	 $this->Email->subject ="SpanishWholesale - Pedido confirmado";
             $this->Email->return = 'info@'.str_replace('www.', '',env('SERVER_NAME'));
        	 $this->Email->from = 'SpanishWholeSale<info@'.str_replace('www.', '', env('SERVER_NAME')).'>';
        	 $this->Email->template = $lang.'pedido_confirmado';
        	 $this->Email->sendAs = 'html';
             $this->Email->delivery= 'mail';
        	 $this->Email->send();
            
        } 
        $this->Session->setFlash(___(utf8_encode("Se guardaron los cambios correctamente"),1));    
        $this->redirect(array('action'=>'edit',$this->data["Pedido"]["id"]));        
    }
    
        function proveedor_mensajeesperando($id)
    {        
        $this->Pedido->id=$id;
        $this->Pedido->saveField('esperando_mercancia',$_POST["confirmado"]);
        App::import('Sanitize');     
        if(isset($_POST["texto"]) && $_POST["texto"]){   
        $mesaje["Mensaje"]["mensaje"]=Sanitize::clean($_POST["texto"], array('encode' => false,'remove_html' => array('remove'=>true),'escape'=>false,'carriage'=>false));
        $mesaje["Mensaje"]["tim"]= DboSource::expression('NOW()');
        $mesaje["Mensaje"]["tipo_mensaje"]= 'esperando';
        $mesaje["Mensaje"]["pedido_id"]= $this->data["Pedido"]["id"];
        
        if(isset($_POST["confirmado"]) && $_POST["confirmado"]=='1')
        {
             $total=$this->Pedido->calcularTotal($id);
             $pedido = $this->Pedido->read();
             $this->loadModel("Usuario");
             $this->Usuario->id=$pedido["Pedido"]["proveedor"];
             $this->Usuario->recursive=-1;
             $provedor=$this->Usuario->read();
            
             $this->set('pedido',$pedido);
             $this->set('proveedor',$provedor);
             $this->set('total',$total);
             $this->set('serializado',unserialize(base64_decode($provedor["Usuario"]["serializado"])));
             /*cosa de lang*/ 
             $lang="eng_";
             if($pedido["Usuario"]["lang"]=='esp')
             $lang="";             
             $this->Email->to = $pedido["Usuario"]["email"];
		 	 $this->Email->subject =___("SpanishWholesale - Pedido esperando",1);
             $this->Email->return = 'info@'.str_replace('www.', '',env('SERVER_NAME'));
        	 $this->Email->from = 'SpanishWholeSale<info@'.str_replace('www.', '', env('SERVER_NAME')).'>';
        	 $this->Email->template = $lang.'pedido_esperando';
        	 $this->Email->sendAs = 'html';
             $this->Email->delivery= 'mail';
        	 $this->Email->send();
        }
        $this->Pedido->Mensaje->save($mesaje);}
        $this->Session->setFlash(___(utf8_encode("Se guardaron los cambios correctamente"),1));         
        $this->redirect(array('action'=>'edit',$this->data["Pedido"]["id"]));        
    }
            function proveedor_enviado($id)
    {        
        $this->Pedido->id=$id;
        $this->Pedido->saveField('enviado',$_POST["confirmado"]);
        $_POST["empresa_transporte"] = trim($_POST["empresa_transporte"]) != "" ? $_POST["empresa_transporte"] : NULL;
        $this->Pedido->saveField('empresa_transporte',$_POST["empresa_transporte"]);
        $this->Pedido->saveField('fecha_salida',$_POST["fecha_salida"]);
        
        if(isset($_POST["confirmado"]) && $_POST["confirmado"]=='1')
        {
             $total=$this->Pedido->calcularTotal($id);
             $pedido = $this->Pedido->read();
             $this->loadModel("Usuario");
             $this->Usuario->id=$pedido["Pedido"]["proveedor"];
             $this->Usuario->recursive=-1;
             $provedor=$this->Usuario->read();
             $this->set('date',$_POST["fecha_salida"]);          
             $this->set('pedido',$pedido);
             $this->set('proveedor',$provedor);
             $this->set('total',$total);
             $this->set('serializado',unserialize(base64_decode($provedor["Usuario"]["serializado"])));
             $lang="eng_";
             if($pedido["Usuario"]["lang"]=='esp')
             $lang="";            
             $this->Email->to = $pedido["Usuario"]["email"];
		 	 $this->Email->subject =___("SpanishWholesale - Pedido enviado",1);
             $this->Email->return = 'info@'.str_replace('www.', '',env('SERVER_NAME'));
        	 $this->Email->from = 'SpanishWholeSale<info@'.str_replace('www.', '', env('SERVER_NAME')).'>';
        	 $this->Email->template = $lang.'pedido_enviado';
        	 $this->Email->sendAs = 'html';
             $this->Email->delivery= 'mail';
        	 $this->Email->send();
        }
        $this->Session->setFlash(___(utf8_encode("Se guardaron los cambios correctamente"),1));  
        $this->redirect(array('action'=>'edit',$this->data["Pedido"]["id"]));        
    }
    
            function proveedor_anulado($id)
    {        
        $this->Pedido->id=$id;
        $this->Pedido->saveField('anulado',$_POST["confirmado"]);
        $this->Pedido->saveField('causa_anulacion',$_POST["causa_anulacion"]);
        
       if(isset($_POST["confirmado"]) && $_POST["confirmado"]=='1')
        {
             
             $total=$this->Pedido->calcularTotal($id);
             $pedido = $this->Pedido->read();
             $this->loadModel("Usuario");
             $this->Usuario->id=$pedido["Pedido"]["proveedor"];
             $this->Usuario->recursive=-1;
             $provedor=$this->Usuario->read();
               
             $this->set('pedido',$pedido);
             $this->set('proveedor',$provedor);
             $this->set('total',$total);
             $this->set('serializado',unserialize(base64_decode($provedor["Usuario"]["serializado"])));
             /*cosa de lang*/ 
             $lang="eng_";
             if($pedido["Usuario"]["lang"]=='esp')
             $lang="";
             $this->Email->to = $pedido["Usuario"]["email"];
		 	 $this->Email->subject = ___("SpanishWholesale - Pedido anulado",1);
             $this->Email->return = 'info@'.str_replace('www.', '',env('SERVER_NAME'));
        	 $this->Email->from = 'SpanishWholeSale<info@'.str_replace('www.', '', env('SERVER_NAME')).'>';
        	 $this->Email->template = $lang.'pedido_anulado';
        	 $this->Email->sendAs = 'html';
             $this->Email->delivery= 'mail';
        	 $this->Email->send();
        }
        $this->Session->setFlash(___(utf8_encode("Se guardaron los cambios correctamente"),1));  
        $this->redirect(array('action'=>'edit',$this->data["Pedido"]["id"]));
    }
    
            function proveedor_existencias($id,$cheked)
    {        
        $this->Pedido->id=$id;
        $existe = $this->Pedido->field('existencias');
        
        if($existe && $cheked)
        $this->Pedido->saveField('existencias',0);
        else
        $this->Pedido->saveField('existencias',1);
        exit();
     //   header("location:".$_SERVER["HTTP_REFERER"]);exit();
    }
    
    function proveedor_restablecer_valores_originales($id = null){
        
        $this->Pedido->unbindModel(array('belongsTo'=>array('Usuario'),'hasMany'=>array('Mensaje')),false);
		$pedidos = $this->Pedido->read(null, $id);
        
        $this->loadModel('Articulo');
        $this->Articulo->recursive = -1;
        foreach($pedidos['Articulo'] as $articulo){
            $this->Articulo->id=$articulo['id'];
            $restore = $this->Articulo->field("serializado");
            $restore = unserialize($restore);
            $restore["id"]=$articulo['id'];
            $this->Articulo->save($restore);
        }
        
        $this->redirect(array('action'=>'edit',$id));
    }
    
    function admin_restablecer_valores_originales($id = null){
        
        $this->Pedido->unbindModel(array('belongsTo'=>array('Usuario'),'hasMany'=>array('Mensaje')),false);
		$pedidos = $this->Pedido->read(null, $id);
        
        $this->loadModel('Articulo');
        $this->Articulo->recursive = -1;
        foreach($pedidos['Articulo'] as $articulo){
            $this->Articulo->id=$articulo['id'];
            $restore = $this->Articulo->field("serializado");
            $restore = unserialize($restore);
            $restore["id"]=$articulo['id'];
            $this->Articulo->save($restore);
        }
        
        $this->redirect(array('action'=>'edit',$id));
    }    
    
    
}
