<?php
class RespuestasController extends AppController {

	var $name = 'Respuestas';

	function admin_index() {
		$this->Respuesta->recursive = 0;
		$this->set('respuestas', $this->paginate());
	}

	function admin_view($id = null) {
	    $this->Respuesta->recursive = -1;
		if (!$id) {
			$this->Session->setFlash(__('Invalid respuesta', true));
			$this->redirect(array('action' => 'index'));
		}
        $this->Respuesta->Consulta->recursive = -1;
        $this->set('consulta', $this->Respuesta->Consulta->read(null, $id));
        $this->set('respuestas', $this->paginate(null,array('consulta_id'=>$id)));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Respuesta->create();
			if ($this->Respuesta->save($this->data)) {
				$this->Session->setFlash(__('The respuesta has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The respuesta could not be saved. Please, try again.', true));
			}
		}
		$consultas = $this->Respuesta->Consulta->find('list');
		$this->set(compact('consultas'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid respuesta', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Respuesta->save($this->data)) {
				$this->Session->setFlash(__('The respuesta has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The respuesta could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Respuesta->read(null, $id);
		}
		$consultas = $this->Respuesta->Consulta->find('list');
		$this->set(compact('consultas'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for respuesta', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Respuesta->delete($id)) {
			$this->Session->setFlash(__('Respuesta deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Respuesta was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
    
	function proveedor_view($id = null) {
	    $this->Respuesta->recursive = -1;
		if (!$id) {
			$this->Session->setFlash(__('Invalid respuesta', true));
			$this->redirect(array('action' => 'index'));
		}
        $this->Respuesta->Consulta->recursive = -1;
        $this->Respuesta->Consulta->id = $id;
        $this->Respuesta->Consulta->saveField("revisado","1");
        $this->set('consulta', $this->Respuesta->Consulta->read(null, $id));
        $this->set('respuestas', $this->paginate(null,array('consulta_id'=>$id)));
	}
    
    function admin_reenviar($id = null) {
        
        if (!$id) {
            $this->redirect($this->referer());
            exit();
        }
        $this->Respuesta->id = $id;
        $respuesta = $this->Respuesta->read(null, $id);
                        
        $this->loadModel("Usuario");
        $this->Usuario->recursive = -1;
        $User = $this->Usuario->read(null,$respuesta['Consulta']['usuario_id']);
        
        $lang='eng_';
        if($User["Usuario"]["lang"]=='esp'){
            $lang='';
        }
                    
        if($this->Respuesta->saveField("reenviado","1")){
            $consulta_id = $respuesta['Consulta']['id'];
            $this->Usuario->query("UPDATE consultas SET usuario_delete='0' WHERE id={$consulta_id}");
        
            if(Configure::read('test_mail')){
                $email = Configure::read('test_mail');
            }else{
                $email = $User["Usuario"]["email"];
            }
            
            //recogemos la respuesta
            $this->set("mail_news",nl2br($respuesta['Respuesta']['respuesta']));
            
            $this->Email->to = $email;
            $this->Email->subject = trim($respuesta['Respuesta']['title']);
            $this->Email->return = 'info@'.str_replace('www.', '',env('SERVER_NAME'));
            $this->Email->from = 'SpanishWholeSale<info@'.str_replace('www.', '', env('SERVER_NAME')).'>';
            $this->Email->template = $lang.'masivo';
            $this->Email->sendAs = 'html';
            $this->Email->delivery= 'mail';
            $this->Email->send();
            
            $this->Session->setFlash(___('La respuesta fue re-enviada', true));
            $this->redirect(array('controller'=>'respuestas','action'=>'view/'.$consulta_id));
        
        }else{
            $this->Session->setFlash(___('Ocurrio un error al momento del envio, por favor intente de nuevo',1));
            $this->redirect($this->referer());
        }
    }
    
}