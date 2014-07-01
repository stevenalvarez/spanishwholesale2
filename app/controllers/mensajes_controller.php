<?php
class MensajesController extends AppController {

	var $name = 'Mensajes';

	function index() {
		$this->Mensaje->recursive = 0;
		$this->set('mensajes', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid mensaje', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('mensaje', $this->Mensaje->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Mensaje->create();
			if ($this->Mensaje->save($this->data)) {
				$this->Session->setFlash(__('The mensaje has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The mensaje could not be saved. Please, try again.', true));
			}
		}
		$pedidos = $this->Mensaje->Pedido->find('list');
		$this->set(compact('pedidos'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid mensaje', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Mensaje->save($this->data)) {
				$this->Session->setFlash(__('The mensaje has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The mensaje could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Mensaje->read(null, $id);
		}
		$pedidos = $this->Mensaje->Pedido->find('list');
		$this->set(compact('pedidos'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for mensaje', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Mensaje->delete($id)) {
			$this->Session->setFlash(__('Mensaje deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Mensaje was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	function admin_index() {
		$this->Mensaje->recursive = 0;
		$this->set('mensajes', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid mensaje', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('mensaje', $this->Mensaje->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
		  
          App::import('Sanitize');
          $this->data = Sanitize::clean($this->data, array('encode' => false,'remove_html' => array('remove'=>true),'escape'=>false,'carriage'=>false));
          $this->data["Mensaje"]["tim"]= DboSource::expression('NOW()');
          $this->data["Mensaje"]["tipo_mensaje"]='Proveedor';
          
                    /**/
          $this->loadModel("Pedido");
          $this->Pedido->id=$this->data["Mensaje"]["pedido_id"];
          $this->Pedido->saveField('mensaje',0);
          $cliente=$this->Pedido->field("usuario_id");          
          $this->loadModel("Usuario");
          $this->Usuario->id=$cliente;        
          
            if(Configure::read('test_mail')){
                $email = Configure::read('test_mail');
            }else{
                $email = $this->Usuario->field("email");
            }
          
            $this->set('mail_news','Te respondieron a tus comentarios en el pedido #'.$this->data["Mensaje"]["pedido_id"]);
            $this->Email->to = $email ;
            $this->Email->subject ="SpanishWholesale - Tienes un mensaje";
            $this->Email->return = 'info@'.str_replace('www.', '',env('SERVER_NAME'));
            $this->Email->from = 'SpanishWholeSale<info@'.str_replace('www.', '', env('SERVER_NAME')).'>';
            $this->Email->template = 'respuesta';
            $this->Email->sendAs = 'html';
            $this->Email->delivery= 'mail';
            $this->Email->send();
          
       
			$this->Mensaje->create();
			if ($this->Mensaje->save($this->data)) {
				$this->Session->setFlash(___('El mensaje fue enviado', true));
				$this->redirect($this->referer());
			} else {
				$this->Session->setFlash(__('The mensaje could not be saved. Please, try again.', true));
			}
		}
        	$this->redirect($this->referer());
        exit();
	}
	function proveedor_add() {
		if (!empty($this->data)) {
		  
          App::import('Sanitize');
          $this->data = Sanitize::clean($this->data, array('encode' => false,'remove_html' => array('remove'=>true),'escape'=>false,'carriage'=>false));
          $this->data["Mensaje"]["tim"]= DboSource::expression('NOW()');
          $this->data["Mensaje"]["tipo_mensaje"]='Proveedor';
          
                    /**/
          $this->loadModel("Pedido");
          $this->Pedido->id=$this->data["Mensaje"]["pedido_id"];
          $this->Pedido->saveField('mensaje',0);
          $cliente=$this->Pedido->field("usuario_id");          
          $this->loadModel("Usuario");
          $this->Usuario->id=$cliente;
          
            if(Configure::read('test_mail')){
                $email = Configure::read('test_mail');
            }else{
                $email = $this->Usuario->field("email");
            }
            
            $respuesta_proveedor = "*Proveedor ". date("Y-m-d H:i:s") .": ".$this->data["Mensaje"]["mensaje"];
            $this->set('mail_news','Te respondieron a tus comentarios en el pedido #'.$this->data["Mensaje"]["pedido_id"]);
            $this->set('respuesta_proveedor',$respuesta_proveedor);
            $this->set('url',"cliente/pedidos/view/".$this->data["Mensaje"]["pedido_id"]);
            $this->Email->to = $email;
            $this->Email->subject ="SpanishWholesale - Tienes un mensaje";
            $this->Email->return = 'info@'.str_replace('www.', '',env('SERVER_NAME'));
            $this->Email->from = 'SpanishWholeSale<info@'.str_replace('www.', '', env('SERVER_NAME')).'>';
            $this->Email->template = 'respuesta';
            $this->Email->sendAs = 'html';
            $this->Email->delivery= 'mail';
            $this->Email->send();
            //echo $this->render('/elements/email/html/respuesta');
       
			$this->Mensaje->create();
			if ($this->Mensaje->save($this->data)) {
				$this->Session->setFlash(___('El mensaje fue enviado', true));
				$this->redirect($this->referer());
			} else {
				$this->Session->setFlash(__('The mensaje could not be saved. Please, try again.', true));
			}
		}
        	$this->redirect($this->referer());
        exit();
	}

    function cliente_add() {
        if (!empty($this->data)) {
            
            App::import('Sanitize');
            $this->data = Sanitize::clean($this->data, array('encode' => false,'remove_html' => array('remove'=>true),'escape'=>false,'carriage'=>false));
            /**/
            $this->loadModel("Pedido");
            $this->Pedido->id=$this->data["Mensaje"]["pedido_id"];
            
            $this->Pedido->saveField('mensaje',1);
            $proveedor_id=$this->Pedido->field("proveedor");
            $this->loadModel("Usuario");
            $this->Usuario->id=$proveedor_id;
            
            if(Configure::read('test_mail')){
                $email = Configure::read('test_mail');
            }else{
                $email = $this->Usuario->field("email");
            }
            
            $name=$this->Auth->user("title");
            $pregunta_cliente = "*Cliente ". date("Y-m-d H:i:s") .": ".$this->data["Mensaje"]["mensaje"];
            
            $this->set('mail_news','El cliente "'.$name.'" te hizo una pregunta en el pedido #'.$this->data["Mensaje"]["pedido_id"]);
            $this->set('pregunta_cliente',$pregunta_cliente);
            $this->Email->to = $email ;
            $this->Email->subject ="SpanishWholesale - Tienes un mensaje de un Cliente";
            $this->Email->return = 'info@'.str_replace('www.', '',env('SERVER_NAME'));
            $this->Email->from = 'SpanishWholeSale<info@'.str_replace('www.', '', env('SERVER_NAME')).'>';
            $this->Email->template = 'pregunta';
            $this->Email->sendAs = 'html';
            $this->Email->delivery= 'mail';
            $this->Email->send();
            /**/
            $this->data["Mensaje"]["tim"]= DboSource::expression('NOW()');
            $this->data["Mensaje"]["tipo_mensaje"]='Cliente';
            $this->Mensaje->create();
            
            if ($this->Mensaje->save($this->data)) {
                $this->Session->setFlash(___('El mensaje fue enviado', true));
                $this->redirect(array('action' => 'view','controller'=>'pedidos',$this->data["Mensaje"]["pedido_id"]));
            } else {
                $this->Session->setFlash(__('The mensaje could not be saved. Please, try again.', true));
            }
        }
        $pedidos = $this->Mensaje->Pedido->find('list');
        $this->set(compact('pedidos'));
    }

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid mensaje', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Mensaje->save($this->data)) {
				$this->Session->setFlash(__('The mensaje has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The mensaje could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Mensaje->read(null, $id);
		}
		$pedidos = $this->Mensaje->Pedido->find('list');
		$this->set(compact('pedidos'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for mensaje', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Mensaje->delete($id)) {
			$this->Session->setFlash(__('Mensaje deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Mensaje was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
