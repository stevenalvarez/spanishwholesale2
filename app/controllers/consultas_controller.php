<?php
class ConsultasController extends AppController {

	var $name = 'Consultas';
	
    function admin_index() {
		$this->Consulta->recursive = 0;
		$this->set('consultas', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid consulta', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('consulta', $this->Consulta->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Consulta->create();
			if ($this->Consulta->save($this->data)) {
				$this->Session->setFlash(__('The consulta has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The consulta could not be saved. Please, try again.', true));
			}
		}
		$usuarios = $this->Consulta->Usuario->find('list');
		$this->set(compact('usuarios'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid consulta', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Consulta->save($this->data)) {
				$this->Session->setFlash(__('The consulta has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The consulta could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Consulta->read(null, $id);
		}
		$usuarios = $this->Consulta->Usuario->find('list');
		$this->set(compact('usuarios'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for consulta', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Consulta->delete($id)) {
			$this->Session->setFlash(__('Consulta deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Consulta was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
    
	function cliente_delete($id = null) {
        if($this->Auth->user("id")){
    		if (!$id) {
    			$this->Session->setFlash(__('Invalid id for consulta', true));
    			$this->redirect($this->referer());
    		}
            $this->Consulta->id = $id;
    		if ($this->Consulta->saveField("usuario_delete",1)) {
    			$this->Session->setFlash(__('Consulta deleted', true));
    			$this->redirect($this->referer());
    		}
    		$this->Session->setFlash(__('Consulta was not deleted', true));
    		$this->redirect($this->referer());
        }else{
            $this->redirect($this->webroot);
        }
	}
    
	function proveedor_delete($id = null) {
        if($this->Auth->user("id")){
    		if (!$id) {
    			$this->Session->setFlash(__('Invalid id for consulta', true));
    			$this->redirect($this->referer());
    		}
            $this->Consulta->id = $id;
    		if ($this->Consulta->saveField("proveedor_delete",1)) {
    			$this->Session->setFlash(__('Consulta deleted', true));
    			$this->redirect($this->referer());
    		}
    		$this->Session->setFlash(__('Consulta was not deleted', true));
    		$this->redirect($this->referer());
        }else{
            $this->redirect($this->webroot);
        }
	}

    function proveedor_index() {
		$miid=$this->Auth->user("id");
        $this->Consultas->recursive = 0;
		$this->set('consultas', $this->paginate(null,array('proveedor_delete'=>'0','revisado'=>'0','usuario_prov_id'=>$miid)));
    }
  
    function proveedor_lista() {
		$miid=$this->Auth->user("id");
        $this->Consultas->recursive = 0;
		$this->set('consultas', $this->paginate(null,array('proveedor_delete'=>'0','revisado'=>'1','usuario_prov_id'=>$miid)));
    }
  
}
