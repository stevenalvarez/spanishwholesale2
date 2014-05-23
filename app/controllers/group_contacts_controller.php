<?php
class GroupContactsController extends AppController {

	var $name = 'GroupContacts';
	var $helpers = array('Html', 'Form');

	function index() {
	   $this->pageTitle="contactos";
	   $this->layout="admin";

		$this->GroupContact->recursive = 0;
		$this->set('groupContacts', $this->paginate());
	}


	function add() {
	  
      $this->pageTitle="contactos";
	   $this->layout="admin"; 
       
		if (!empty($this->data)) {
		     
       $this->data["GroupContact"]["sql"]="select * from (SELECT email,nombre from `mailing_{$this->data["GroupContact"]["name_group"]}`) as t";
       $this->data["GroupContact"]["table"]="t";
                  
       $this->data["GroupContact"]["replaces"]="nombre-email";
       $this->data["GroupContact"]["autolist"]="1";
	  if ($this->GroupContact->save($this->data)) {			
                
                $this->GroupContact->query("CREATE TABLE `mailing_{$this->data["GroupContact"]["name_group"]}` (
                    `email` varchar(200) DEFAULT NULL,
                    `nombre` varchar(200) DEFAULT NULL,
                    PRIMARY KEY (`email`)
                    ) ENGINE=MyISAM DEFAULT CHARSET=latin1;");
                $this->Session->setFlash(__('El grupo fue guardado', true));    
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('no se pudo guardar.', true));
			}
		}
	}

	function edit($id = null) {
	   
       $this->pageTitle="contactos";
	   $this->layout="admin";
       
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid GroupContact', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->GroupContact->save($this->data)) {
				$this->Session->setFlash(__('The GroupContact has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The GroupContact could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->GroupContact->read(null, $id);
		}
	}

	function delete($id = null) {
	   
       $gr=$this->GroupContact->findById($id);
              
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for GroupContact', true));
			$this->redirect(array('action' => 'index'));
		}
		if ($this->GroupContact->del($id)) {
		    $this->GroupContact->query("drop table `mailing_{$gr['GroupContact']['name_group']}`");
			$this->Session->setFlash(__('GroupContact deleted', true));
            
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('The GroupContact could not be deleted. Please, try again.', true));
		$this->redirect(array('action' => 'index'));
	}

}
?>