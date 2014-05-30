<?php
class TranslatesController extends AppController {

	var $name = 'Translates';
    function beforeFilter() {
    $this->Auth->allow('change');
    parent::beforeFilter();
 }   
//	function index() {
//		$this->Translate->recursive = 0;
//       
//        
//		$this->set('translates', $this->paginate());
//	}
//
//	function view($id = null) {
//		if (!$id) {
//			$this->Session->setFlash(__('Invalid translate', true));
//			$this->redirect(array('action' => 'index'));
//		}
//		$this->set('translate', $this->Translate->read(null, $id));
//	}
//
//	function add() {
//		if (!empty($this->data)) {
//			$this->Translate->create();
//			if ($this->Translate->save($this->data)) {
//				$this->Session->setFlash(__('The translate has been saved', true));
//				$this->redirect(array('action' => 'index'));
//			} else {
//				$this->Session->setFlash(__('The translate could not be saved. Please, try again.', true));
//			}
//		}
//	}
//
//	function edit($id = null) {
//		if (!$id && empty($this->data)) {
//			$this->Session->setFlash(__('Invalid translate', true));
//			$this->redirect(array('action' => 'index'));
//		}
//		if (!empty($this->data)) {
//			if ($this->Translate->save($this->data)) {
//				$this->Session->setFlash(__('The translate has been saved', true));
//				$this->redirect(array('action' => 'index'));
//			} else {
//				$this->Session->setFlash(__('The translate could not be saved. Please, try again.', true));
//			}
//		}
//		if (empty($this->data)) {
//			$this->data = $this->Translate->read(null, $id);
//		}
//	}
//
//	function delete($id = null) {
//		if (!$id) {
//			$this->Session->setFlash(__('Invalid id for translate', true));
//			$this->redirect(array('action'=>'index'));
//		}
//		if ($this->Translate->delete($id)) {
//			$this->Session->setFlash(__('Translate deleted', true));
//			$this->redirect(array('action'=>'index'));
//		}
//		$this->Session->setFlash(__('Translate was not deleted', true));
//		$this->redirect(array('action' => 'index'));
//	}




    public function admin_traducir()
    {
        $_SESSION["cake_lang"]='eng';
        $_SESSION['traducir']='true';
        $this->redirect($this->webroot);        
        
    }



	function admin_index() {
	    
		$this->Translate->recursive = 0;
		$this->set('translates', $this->paginate(null));
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid translate', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('translate', $this->Translate->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Translate->create();
			if ($this->Translate->save($this->data)) {
				$this->Session->setFlash(__('The translate has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The translate could not be saved. Please, try again.', true));
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid translate', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
		if ($this->Translate->save($this->data)) {
				$this->Session->setFlash(___('Se guard&oacute; la traducci&oacute;n', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The translate could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Translate->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for translate', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Translate->delete($id)) {
			$this->Session->setFlash(__('Translate deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Translate was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
    
    function admin_ajaxedit()
    {
        $trans=$this->Translate->findbyEsp($_POST["val"]);
        
        if($trans)
        {
        
        $this->Translate->id=$trans["Translate"]["id"];
        $this->Translate->saveField('eng',$_POST["trad"]);
        echo "ok";
        exit();
        }
        else
        {
            echo "false";
        }
        exit();
    }
    
    function change($language){
        $_SESSION["cake_lang"]=$language;
        
        if($_SERVER['HTTP_REFERER'])
        $this->redirect($_SERVER['HTTP_REFERER']);
        else
        $this->redirect($_SERVER["PHP_SELF"]);
        
    }
}
