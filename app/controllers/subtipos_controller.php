<?php
class SubtiposController extends AppController {

	var $name = 'Subtipos';

	function admin_index() {
		$this->Subtipo->recursive = 0;
        if(isset($_GET["search"]))
        {
        $this->set('subtipos',$this->paginate(null,array("{$_POST["criterio"]} like '%{$_POST["like"]}%'")));
        }
        else
		$this->set('subtipos', $this->paginate());
	}


	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid subtipo', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('subtipo', $this->Subtipo->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Subtipo->create();
			if ($this->Subtipo->save($this->data)) {
				$this->Session->setFlash(__('El subtipo fue guardado', true));
                
                if($_POST["step"]==utf8_encode('SALVAR Y REGISTRAR OTRO SUBTIPO'))
                {$this->redirect(array('action' => 'add')); exit();}
                else
                $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The subtipo could not be saved. Please, try again.', true));
			}
		}
	
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid subtipo', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Subtipo->save($this->data)) {
				$this->Session->setFlash(__('El subtipo fue editado', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The subtipo could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Subtipo->read(null, $id);
		}
	
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for subtipo', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Subtipo->delete($id)) {
			$this->Session->setFlash(__('Subtipo deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Subtipo was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
    
    
   function admin_options($id = null) {
		if (!$id) {
		exit();
		}
		if (ctype_digit(($id))) {
			$list = $this->Subtipo->find('list',array('conditions'=>array('tipo_id'=>$id)));
            
            foreach($list as $k=>$v )
            {?>
            <option value="<?php echo $k?>"><?php echo $v?></option>
            <?php
            }
            exit();
		}
    exit();
	}
}
