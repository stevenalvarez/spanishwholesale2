<?php
class UserlogsController extends AppController {

	var $name = 'Userlogs';

	function index() {
		$this->Userlog->recursive = 0;
		$this->set('userlogs', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid userlog', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('userlog', $this->Userlog->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Userlog->create();
			if ($this->Userlog->save($this->data)) {
				$this->Session->setFlash(__('The userlog has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The userlog could not be saved. Please, try again.', true));
			}
		}
		$usuarios = $this->Userlog->Usuario->find('list');
		$this->set(compact('usuarios'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid userlog', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Userlog->save($this->data)) {
				$this->Session->setFlash(__('The userlog has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The userlog could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Userlog->read(null, $id);
		}
		$usuarios = $this->Userlog->Usuario->find('list');
		$this->set(compact('usuarios'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for userlog', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Userlog->delete($id)) {
			$this->Session->setFlash(__('Userlog deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Userlog was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	function admin_index() {
		$this->Userlog->recursive = 0;
         if(isset($_GET["search"]))
        {            
            $pag= $this->paginate('Userlog',array("Usuario.{$_POST["criterio"]} like '%{$_POST["like"]}%'"));
        }
        else if(isset($_GET["user"])){
            $pag= $this->paginate('Userlog',array("Usuario.id='{$_GET["user"]}'"));
        }
        else
        {    
            $pag= $this->paginate('Userlog');
        }
		$this->set('userlogs', $pag);
	}
    function admin_logueados() {
		$this->Userlog->recursive = 0;
        $pag= $this->paginate('Userlog',array("(Userlog.operacion='logueado' or  Userlog.operacion='login cliente' )  ","date(Userlog.tim)=curdate()"));
        $this->set('userlogs', $pag);
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid userlog', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('userlog', $this->Userlog->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Userlog->create();
			if ($this->Userlog->save($this->data)) {
				$this->Session->setFlash(__('The userlog has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The userlog could not be saved. Please, try again.', true));
			}
		}
		$usuarios = $this->Userlog->Usuario->find('list');
		$this->set(compact('usuarios'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid userlog', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Userlog->save($this->data)) {
				$this->Session->setFlash(__('The userlog has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The userlog could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Userlog->read(null, $id);
		}
		$usuarios = $this->Userlog->Usuario->find('list');
		$this->set(compact('usuarios'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for userlog', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Userlog->delete($id)) {
			$this->Session->setFlash(__('Userlog deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Userlog was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
    
    function admin_seo()
    {   
        if(isset($_POST["seo"]))
        {
            $seo=$_POST["seo"];            
            $seo=base64_encode(serialize($seo));
            $this->Userlog->query("update seo set v='$seo' where k='seo'");
        }
       $seo=$this->Userlog->query("select v from seo where k='seo'");
    //   echo base64_decode($seo[0]["seo"]["v"]);
       $seo= unserialize(base64_decode($seo[0]["seo"]["v"]));

       $this->set('seo',$seo);
       
    }
}
