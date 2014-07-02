<?php

class GestionNewsletterController extends AppController {
		
		var $name = 'GestionNewsletter';
		var $components = array('Email');
        //var $components = array('Auth', 'Email');                
		var $pageTitle = "Gestion Newsletters";
		var $paginate = array(
	        'limit' => 10,
	        'order' => array('GestionNewsletter.id' => 'ASC')
	    );
        var $helpers = array('Html', 'Form', 'Fck','Csv');
        /*variable que indica el e-mail de administrador a quien le llegan las notificaciones*/
		var $email_admin=Configure::read('admin-email');
     
    	function index(){
			$this->layout = "admin";
            $this->pageTitle = "GESTION NEWSLETTERS";
			$this->set("seccionestabs", $this->paginate("GestionNewsletter"));
		}
        
        function import()
        {
             $this->pageTitle="IMPORTAR";
            
            if($_FILES)
                {
                    //cargo el modelo
                    $this->render("blank","admin");
                    $this->loadModel('Newsletteremail');                                        
                    $filepath=$_FILES["file"]["tmp_name"];
                    App::import("Vendor","parsecsv");
                    $csv = new parseCSV();
                    $csv->auto($filepath);
                    
                    $name=$_FILES["file"]["name"];
                    $name=preg_replace('/[^a-z0-9]/',"",$name);
                    
                    $test=$this->Newsletteremail->query("CREATE TABLE `mailing_$name` (
                    `email` varchar(200) DEFAULT NULL,
                    `nombre` varchar(200) DEFAULT NULL,
                    PRIMARY KEY (`email`)
                    ) ENGINE=MyISAM DEFAULT CHARSET=latin1;");
                    
                    
                    $test=$this->Newsletteremail->query("INSERT INTO `mailing_group_contacts` (`name_group`, `sql`, `table`, `descripcion`, `replaces`) VALUES 
                    ('$name', 'select * from (SELECT email,nombre from `mailing_$name`) as t', 't', NULL, 'nombre-email')");                     
                    foreach ($csv->data as $row)  
                        {  
                            
                            $email=$row["email"];
                            $nombre=$row["nombre"];
                            
                     $sql="INSERT INTO `mailing_$name` (`email`, `nombre`) VALUES ('$email', '$nombre')" ;
                       //   echo $sql; 
                    $test=$this->Newsletteremail->query($sql);
                    $mensaje.="El e-mail ".$email." se registro satisfactoriamente<br>";
                                                                                                                                     
                      
                }
              //  echo $mensaje;
                 $_SESSION["mensaje"]=$mensaje;
                }
                else
                {
                    $this->layout = "admin";
                    $this->loadModel('GroupContacts');
                    $groups = $this->GroupContacts->find('all');                    
                    $this->set(compact('groups'));                   
                }
                            
        } 
        
 		function listSuscriptores($grupo=10){
		  
          
          $page=0;
          if(isset($this->passedArgs["page"]))
          $page=$this->passedArgs["page"];
          
          
			$this->layout = "admin";
            $this->pageTitle="SUSCRIPTORES";
            $this->loadModel('GroupContacts');
            $pagex=$page*100;
            $limit=" limit $pagex, 100";

                                    
           $group=$this->GroupContacts->findById($grupo);
           
           $table=$group["GroupContacts"]["table"];
           
           
           $mails = $this->GroupContacts->query($group["GroupContacts"]["sql"].$limit);
                                                                                    
          
                if(isset($_POST["action"]))
                if($_POST["action"]=="buscar")
                {
                   
                    $tipo=$_POST["tipo"];
                    $nombre=$_POST["nombre"];
                    
                                        
                    $mails = $this->GroupContacts->query($group["GroupContacts"]["sql"]." where 
                    $tipo like '%$nombre%' ORDER by $tipo");
                     $table=$group["GroupContacts"]["table"];
                     $tipo="buscar";
                    
                }
                                
            $this->loadModel('GroupContacts');
            $groups = $this->GroupContacts->find('all');

            $selectGroups=array();
           // $selectGroups[0]="Todos";
            foreach($groups as $group) {
                $selectGroups[$group['GroupContacts']['id']]= $group['GroupContacts']['name_group'];
            }
            $this->set("selected_group",$grupo);
            $this->set("selectGroups",$selectGroups);            
            $this->set("mails", $mails);
             $this->set("table", $table);
            //$this->set("table", $table);
            $this->set("page", $page);
            $this->set("grupo", $grupo);
            if(isset($tipo))
            $this->set("tipo", $tipo);
		}
        
        function addSuscriptor(){
            
             $this->loadModel('GroupContacts');
            
             if($_POST)
            {
             $adg= $this->GroupContacts->findById($_POST["grupo"]);
             $name=$adg["GroupContacts"]["name_group"];
                
             $sql="INSERT INTO `mailing_$name` (`email`, `nombre`) VALUES ('{$_POST["data"]["GestionNewsletter"]["email"]}', '{$_POST["data"]["GestionNewsletter"]["nombre"]}')";
             $test=$this->GroupContacts->query($sql);
            // echo $sql;
             $this->redirect(array("action"=>"listSuscriptores",$adg["GroupContacts"]["id"]));
             exit();                
             }
            
            
           
            $this->layout = "admin";
            $this->pageTitle="SUSCRIPTORES";
            
            $groups = $groups = $this->GroupContacts->findAll(array("autolist"=>'1'));            
            $grupo=10;
            if($_GET["grupo"])
            {
               $grupo = $_GET["grupo"];
                
            }

           
            
            $this->set("grupo",$grupo);
            $this->set("grupos",$groups);
       }
       

       
       function exportCsv(){
        $this->loadModel('Newsletteremail');
        $this->set('newslettermails', $this->Newsletteremail->find('all'));
        $this->layout = null;
        $this->autoLayout = false; 
        Configure::write('debug', '0');
       }
       
       function listPlantillas(){
        $this->pageTitle="PLANTILLAS";
            $this->layout = "admin";
            $this->loadModel('Plantillasnews');
            $this->paginate = array(
	        'limit' => 10,
	        'order' => array('Plantillasnews.id' => 'ASC')
	        );
            
            $this->set("plantillasnewsletter", $this->paginate("Plantillasnews"));
      }
       
      function addPlantilla(){
        $this->layout = "admin";
        $this->pageTitle="PLANTILLAS";
        $this->loadModel('Plantillasnews');
        if($this->data){
          //  $nueva_plantilla = fopen("templates_news/".str_replace(" ","_",$this->data['Plantillasnews']['titleesp_pnewsletter']).".html","w+");  
//            $this->data['Plantillasnews']['link_pnewsletter']=str_replace(" ","_",$this->data['Plantillasnews']['titleesp_pnewsletter']);
//            
//            /*SE REQUIERE INDICAR LA RUTA DEL SERVIDOR DONDE SE ENCUENTRAN LOS ARCHIVOS MULTIMEDIA*/
         $this->data['Plantillasnews']['bodyesp_html']=str_replace('src="/','src="http://www.patrocinalos.com/',$this->data['Plantillasnews']['bodyesp_html']);
         $this->data['Plantillasnews']['bodyeng_html']=str_replace('src="/','src="http://www.patrocinalos.com/',$this->data['Plantillasnews']['bodyeng_html']);
         $this->data['Plantillasnews']['bodyita_html']=str_replace('src="/','src="http://www.patrocinalos.com/',$this->data['Plantillasnews']['bodyita_html']);
         			
//			/*SE REQUIERE INDICAR LA RUTA DEL SERVIDOR DONDE SE ENCUENTRAN LOS ARCHIVOS MULTIMEDIA*/
//            $this->data['Plantillasnews']['date_pnewsletter']=date("Y-m-d");
//            $html='
//            <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
//                <html xmlns="http://www.w3.org/1999/xhtml">
//                <head>
//                    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
//                    <title>Documento sin título</title>
//                </head>
//                <body>
//                '.$this->data['Plantillasnews']['bodyesp_html'].'
//                </body>
//                </html>
//            ';
//            fwrite($nueva_plantilla, $html. PHP_EOL);
//            if($nueva_plantilla == false){  
//                die("No se ha podido crear la plantilla.");  
//            }
            
            if($this->Plantillasnews->save($this->data)){
               	    $this->Session->setFlash('La plantilla fue creada exitosamente.', 'default', array("class"=>"alerta success"));
					$this->redirect('listPlantillas');
			}else{
					$this->Session->setFlash('Error al crear la plantilla. Inténtelo de nuevo más tarde.', 'default', array("class"=>"alerta error"));
			}    
        }
          
      }
      
      function editPlantilla($id=null){
			$this->layout = "admin";
             $this->pageTitle="PLANTILLAS";
            $this->loadModel('Plantillasnews');
            
			if($id){
				$plantilla = $this->Plantillasnews->findById($id);
              	if($plantilla){
					if($this->data){
					   
                         $this->data['Plantillasnews']['bodyesp_html']=str_replace('src="/','src="http://www.patrocinalos.com/',$this->data['Plantillasnews']['bodyesp_html']);
                         $this->data['Plantillasnews']['bodyeng_html']=str_replace('src="/','src="http://www.patrocinalos.com/',$this->data['Plantillasnews']['bodyeng_html']);
                         $this->data['Plantillasnews']['bodyita_html']=str_replace('src="/','src="http://www.patrocinalos.com/',$this->data['Plantillasnews']['bodyita_html']);

                       
                       
					    /*SE REQUIERE INDICAR LA RUTA DEL SERVIDOR DONDE SE ENCUENTRAN LOS ARCHIVOS MULTIMEDIA*/
//                        $this->data['Plantillasnews']['bodyesp_html']=str_replace('src="/'.substr(Router::url('/'),1),'src="http://'.$_SERVER['HTTP_HOST'].''.Router::url('/'),$this->data['Plantillasnews']['bodyesp_html']);						
//					    /*SE REQUIERE INDICAR LA RUTA DEL SERVIDOR DONDE SE ENCUENTRAN LOS ARCHIVOS MULTIMEDIA*/
//                        $this->data['Plantillasnews']['date_pnewsletter']=date("Y-m-d");
                        if($this->Plantillasnews->save($this->data)){
							$this->Session->setFlash('La plantilla fue modificado exitosamente.', 'default', array("class"=>"alerta success"));
							$this->redirect('listPlantillas');
						}else{
							$this->Session->setFlash('Error al modificar la plantilla. Int?ntelo de nuevo m?s tarde.', 'default', array("class"=>"alerta error"));
						}
					}
					$this->data = $plantilla;
				}else{
					$this->redirect('addPlantilla');
				}
			}else{
			 
				$this->redirect('listPlantillas');
			}
	   }
      
      
      function previewPlantilla($id=null){
        $this->layout = "blank";
        $this->loadModel('Plantillasnews');
        $plantilla = $this->Plantillasnews->findById($id);
        $this->set("plantilla", $plantilla);
      }  
      
      function deletePlantilla($id=null){
        $this->pageTitle = "Nueva Plantilla";
        $this->layout = "admin";
        $this->loadModel('Plantillasnews');
        if($id){
				$plantilla= $this->Plantillasnews->findById($id); 
                $this->Plantillasnews->del($id);
                
				$this->Session->setFlash('Se ha eliminado correctamente la plantilla.', 'default', array("class"=>"alerta success"));
			    /*if (unlink("'".$plantilla["Plantillasnews"]["link_pnewsletter"].".html")){
                        echo 'no se pudo borrar el archivo :'.$plantilla["Plantillasnews"]["link_pnewsletter"].".html";
                    }*/             }
			$this->redirect('listPlantillas');
      }
      
      function admin_listMessages(){
          $this->layout = "admin";
           $this->pageTitle="MENSAJES";
            $this->loadModel('Message');
            $this->paginate = array(
	        'limit' => 10,
	        'order' => array('Message.id' => 'ASC')
	        );
            
            $this->set("messages", $this->paginate("Message"));
      }
      
      function admin_sendMessage($id_member=null){
                       
         $this->layout = "admin";
         $this->pageTitle="MENSAJES";
    //     $this->loadModel('Message');
//         $this->loadModel('Plantillasnews');
//         $plantillas = $this->Plantillasnews->find("all");
//         $this->set("plantillas", $plantillas);
//         $send_mail=false;
//         $message=null;        
         
         if($this->data){   
            
    
                $this->loadModel('GroupContacts');
                $group=$this->GroupContacts->findById($this->data['Message']['grupo']);
                $mails = $this->GroupContacts->query($group["GroupContacts"]["sql"]);
                $table=$group["GroupContacts"]["table"];
                $replaces=explode("-",$group["GroupContacts"]["replaces"]);
                
  
            $i=0;
            $destinatarios='';
            foreach($mails as $mail){//bucle que manda mails a todos los usuarios puede
            //llegar a dar error si no se pone un tiempo alto
            
                $message=$this->data['Message']['message']; //por defecto en español
                $this->data['Message']['subject']=$this->data['Message']['asunto'];
                //remplazar nombres
                $vis='';
                                    
                foreach($replaces as $replace)
                {
                    $message=str_replace("[".$replace."]",$mail[$table][$replace],$message);
                    $vis=$vis."&$replace={$mail[$table][$replace]}";
                }
                
              
                    
             //$mail[$table]['email']="test@test.com";//
 			 $this->set('mail_news', $message);
             $this->Email->to = $mail[$table]['email'];
			// $this->Email->bcc = "";
			 $this->Email->subject ="SpanishWholesale - ".$this->data['Message']['asunto'];
			 $this->Email->from = 'SpanishWholesale <noreply@'.str_replace('www.', '', env('SERVER_NAME')).'>';
             $this->Email->return = 'noreply@'.str_replace('www.', '',env('SERVER_NAME'));
			 $this->Email->template = 'masivo';
			 $this->Email->sendAs = 'both';
             
             if(!$_POST["simular"])
             {             
			 $send_mail=$this->Email->send();
             }
             else
             {
                echo "Mensaje para: ".$mail[$table]['email']."<br>";
                echo "Mensaje de: ".'Mazzel <noreply@'.str_replace('www.', '', env('SERVER_NAME')).'><br>';
                echo "Asunto: "."Mazzel - ".$this->data['Message']['subject']."<br><br>";
                echo $message;
                echo "<br><hr>";
             }
             $destinatarios.="<br>".$mail[$table]["email"];
             $i++;
           
            }

           //para el administrador
             $this->set('mail_news', $message."<hr>Se mando mails a los siguientes destinatarios<hr>:".$destinatarios);
             $this->Email->to = $this->email_admin;
			 $this->Email->subject ="SpanishWholesale this mail was send $i times - ".$this->data['Message']['subject'];
			 $this->Email->from = 'SpanishWholesale <noreply@'.str_replace('www.', '', env('SERVER_NAME')).'>';
             $this->Email->return = 'noreply@'.str_replace('www.', '',env('SERVER_NAME'));
			 $this->Email->template = 'masivo';
			 $this->Email->sendAs = 'both';
			 $send_mail=$this->Email->send();
           // variables para guardar en la plantilla
                 
    
           
             $this->data['Message']['message']=$this->data['Message']['asunto'];
             $this->data['Message']['count']="1";
             $this->data['Message']['limit']='todo';
             $this->data['Message']['grupo']=$group["GroupContacts"]["name_group"];
             $this->data['Message']['grupo_id']=$group["GroupContacts"]["id"];
             $this->data['Message']['envios']=$i;
             
            $this->loadModel('Message');             
            if(!$_POST["simular"])//si no es para simular 
            if($this->Message->save($this->data)){
               	    $this->Session->setFlash('El mensaje fue enviado exitosamente a '.$i.' direcciones de correo', 'default', array("class"=>"alerta success"));
					$this->redirect('listMessages');
			}else{
					$this->Session->setFlash('Error al enviar el mensaje. Int&eacute;ntelo de nuevo m&aacute;s tarde.'.$this->data['Message']['message'], 'default', array("class"=>"alerta error"));
			}  
                
            $this->redirect('listMessages');
         }
            
            $this->loadModel('GroupContacts');
            $selectGroups=array();
            $groups = $this->GroupContacts->find('all');
            foreach ($groups as $group) {
                $selectGroups[$group['GroupContacts']['id']]= $group['GroupContacts']['name_group'];
            }
            
            $this->set("selectGroups",$selectGroups);
         
      }
      ////////////////////para los que terminaron su patrocinio ///////////////////
      
      
      
     function sendMessageto($email=null){
        
        if  (isset($_POST["data"]["Message"]["message"]))
        if($_POST["data"]["Message"]["message"])
        $_POST["data"]["Message"]["message"]=stripslashes($_POST["data"]["Message"]["message"]);

         $this->layout = "admin";
         $this->pageTitle="MENSAJES";
         $this->loadModel('Message');
         $this->loadModel('Plantillasnews');
         $plantillas = $this->Plantillasnews->find("all");
         $this->set("plantillas", $plantillas);
        
        // $user_mail=$this->Plantillasnews->query("select email from maz_usuarios where nid = $email");
       //  $email=$user_mail['0']['maz_usuarios']['email'];         
                        
         $send_mail=false;
         $message=null;
         if(isset($_POST["data"]["Message"]["message"]))
         if($_POST["data"]["Message"]["message"]){            
         
             $this->set('mail_news',$_POST["data"]["Message"]["message"]);
             $this->Email->to = $_POST["to"];
			 $this->Email->subject ="Patrocinalos - ".$_POST["asunto"];
			 $this->Email->from = 'Patrocinalos by Mazzel<noreply@'.str_replace('www.', '', env('SERVER_NAME')).'>';
             $this->Email->return = 'noreply@'.str_replace('www.', '',env('SERVER_NAME'));
			 $this->Email->template = 'newsletter';
			 $this->Email->sendAs = 'both';
			 $send_mail=$this->Email->send();

            if($send_mail){
               	    $this->Session->setFlash('El mensaje fue enviado exitosamente.', 'default', array("class"=>"alerta success"));
					$this->redirect('listMessages');
			}else{
					$this->Session->setFlash('Error al enviar el mensaje. Int&eacute;ntelo de nuevo m&aacute;s tarde.'.$this->data['Message']['message'], 'default', array("class"=>"alerta error"));
			}  
                
            $this->redirect('listMessages');
         }
         
          $email=$this->passedArgs["mail"];
          $name=$this->passedArgs["name"];      
            
         $this->set("email",$email);
          $this->set("name",$name);
         
       
      }
      
      
      
      function backList(){
        $this->layout = "admin";
        $this->pageTitle="BACKLIST";
            $this->loadModel('Backlists');
            $this->paginate = array(
	        'limit' => 10,
	        'order' => array('Backlists.id' => 'ASC')
	        );
            
            $this->set("rules", $this->paginate("Backlists"));
      }
      
      function addRule(){
        $this->layout = "admin";
        $this->pageTitle="BACKLIST";
        $this->loadModel('Backlists');
			if($this->data){
				if($this->Backlists->save($this->data)){
					$this->Session->setFlash('La regla se aplic&oacute; exitosamente.', 'default', array("class"=>"alerta success"));
					$this->redirect('backList');
				}else{
					$this->Session->setFlash('Error al aplicar regla. Int&eacute;ntelo de nuevo m&aacute;s tarde.', 'default', array("class"=>"alerta error"));
				}
			}
      }
      
      function editRule($id=null){
        	$this->layout = "admin";
            $this->loadModel('Backlists');
         	if($id){
				$rule = $this->Backlists->findById($id);
              	if($rule){
					if($this->data){
						if($this->Backlists->save($this->data)){
							$this->Session->setFlash('La regla fue modificada exitosamente.', 'default', array("class"=>"alerta success"));
							$this->redirect('backList');
						}else{
							$this->Session->setFlash('Error al modificar la regla. Int&eacute;ntelo de nuevo m&aacute;s tarde.', 'default', array("class"=>"alerta error"));
						}
					}
					$this->data = $rule;
				}else{
					$this->redirect('addRule');
				}
			}else{
			 
				$this->redirect('backList');
			}
      }
      
      function deleteRule($id=null){
        $this->layout = "admin";
        $this->loadModel('Backlists');
        if($id){
				$rule= $this->Backlists->findById($id); 
                $this->Backlists->del($id);
            	$this->Session->setFlash('Se ha eliminado correctamente la regla.', 'default', array("class"=>"alerta alert"));
			   }
			$this->redirect('backList');
      }
      
      function ckeckRule($rule=null){
         $this->layout = "blank";
         $this->loadModel('Newsletteremail');
         $newslettermails=$this->Newsletteremail->find('all',array('conditions'=>array('Newsletteremail.email LIKE' => '%'.$rule.'%')));
         $this->set("newslettermails", $newslettermails);
      }
      
}

?>