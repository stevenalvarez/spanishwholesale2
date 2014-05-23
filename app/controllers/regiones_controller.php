<?php
class RegionesController extends AppController {

	var $name = 'Regiones';
    
        function beforeFilter() {    
    $this->Auth->allow('ajaxoptions');
    parent::beforeFilter();
    }   
    

//	function index() {
//		$this->Regione->recursive = 0;
//		$this->set('regiones', $this->paginate());
//	}
//
//	function view($id = null) {
//		if (!$id) {
//			$this->Session->setFlash(__('Invalid regione', true));
//			$this->redirect(array('action' => 'index'));
//		}
//		$this->set('regione', $this->Regione->read(null, $id));
//	}
//
//	function add() {
//		if (!empty($this->data)) {
//			$this->Regione->create();
//			if ($this->Regione->save($this->data)) {
//				$this->Session->setFlash(__('The regione has been saved', true));
//				$this->redirect(array('action' => 'index'));
//			} else {
//				$this->Session->setFlash(__('The regione could not be saved. Please, try again.', true));
//			}
//		}
//		$countries = $this->Regione->Country->find('list');
//		$this->set(compact('countries'));
//	}
//
//	function edit($id = null) {
//		if (!$id && empty($this->data)) {
//			$this->Session->setFlash(__('Invalid regione', true));
//			$this->redirect(array('action' => 'index'));
//		}
//		if (!empty($this->data)) {
//			if ($this->Regione->save($this->data)) {
//				$this->Session->setFlash(__('The regione has been saved', true));
//				$this->redirect(array('action' => 'index'));
//			} else {
//				$this->Session->setFlash(__('The regione could not be saved. Please, try again.', true));
//			}
//		}
//		if (empty($this->data)) {
//			$this->data = $this->Regione->read(null, $id);
//		}
//		$countries = $this->Regione->Country->find('list');
//		$this->set(compact('countries'));
//	}
//
//	function delete($id = null) {
//		if (!$id) {
//			$this->Session->setFlash(__('Invalid id for regione', true));
//			$this->redirect(array('action'=>'index'));
//		}
//		if ($this->Regione->delete($id)) {
//			$this->Session->setFlash(__('Regione deleted', true));
//			$this->redirect(array('action'=>'index'));
//		}
//		$this->Session->setFlash(__('Regione was not deleted', true));
//		$this->redirect(array('action' => 'index'));
//	}
//	function admin_index() {
//		$this->Regione->recursive = 0;
//		$this->set('regiones', $this->paginate());
//	}
//
//	function admin_view($id = null) {
//		if (!$id) {
//			$this->Session->setFlash(__('Invalid regione', true));
//			$this->redirect(array('action' => 'index'));
//		}
//		$this->set('regione', $this->Regione->read(null, $id));
//	}
//
//	function admin_add() {
//		if (!empty($this->data)) {
//			$this->Regione->create();
//			if ($this->Regione->save($this->data)) {
//				$this->Session->setFlash(__('The regione has been saved', true));
//				$this->redirect(array('action' => 'index'));
//			} else {
//				$this->Session->setFlash(__('The regione could not be saved. Please, try again.', true));
//			}
//		}
//		$countries = $this->Regione->Country->find('list');
//		$this->set(compact('countries'));
//	}
//
//	function admin_edit($id = null) {
//		if (!$id && empty($this->data)) {
//			$this->Session->setFlash(__('Invalid regione', true));
//			$this->redirect(array('action' => 'index'));
//		}
//		if (!empty($this->data)) {
//			if ($this->Regione->save($this->data)) {
//				$this->Session->setFlash(__('The regione has been saved', true));
//				$this->redirect(array('action' => 'index'));
//			} else {
//				$this->Session->setFlash(__('The regione could not be saved. Please, try again.', true));
//			}
//		}
//		if (empty($this->data)) {
//			$this->data = $this->Regione->read(null, $id);
//		}
//		$countries = $this->Regione->Country->find('list');
//		$this->set(compact('countries'));
//	}
//
//	function admin_delete($id = null) {
//		if (!$id) {
//			$this->Session->setFlash(__('Invalid id for regione', true));
//			$this->redirect(array('action'=>'index'));
//		}
//		if ($this->Regione->delete($id)) {
//			$this->Session->setFlash(__('Regione deleted', true));
//			$this->redirect(array('action'=>'index'));
//		}
//		$this->Session->setFlash(__('Regione was not deleted', true));
//		$this->redirect(array('action' => 'index'));
//	}
    
    	function admin_ajaxoptions($conuntry_id) {
        $paises=$this->Regione->find('list',array('conditions'=>array('country_id' => $conuntry_id),'order'=>'title' ));
        
        
        foreach($paises as $k=>$v)
        {
            echo "<option value='$k'>$v</option>";
        }
        exit();
        

	}
        	function ajaxoptions($conuntry_id) {
        $paises=$this->Regione->find('list',array('conditions'=>array('country_id' => $conuntry_id),'order'=>'title' ));
        
        
        foreach($paises as $k=>$v)
        {
            echo "<option value='$k'>$v</option>";
        }
        exit();
        

	}
    
    
    
}
