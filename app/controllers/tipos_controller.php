<?php
class TiposController extends AppController {

	var $name = 'Tipos';

	function admin_index() {
		$this->Tipo->recursive = 0;
        
        if(isset($_GET["search"]))
        {
        $this->set('tipos',$this->paginate(null,array("{$_POST["criterio"]} like '%{$_POST["like"]}%'")));
        }
        else
		$this->set('tipos', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid tipo', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('tipo', $this->Tipo->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Tipo->create();
			if ($this->Tipo->save($this->data)) {
				$this->Session->setFlash(__('Se gurado el tipo', true));
				
            if($_POST["step"]==utf8_encode('SALVAR Y REGISTRAR OTRO TIPO'))
                {$this->redirect(array('action' => 'add')); exit();}
                else
                $this->redirect(array('action' => 'index'));
            
            } else {
				$this->Session->setFlash(__('The tipo could not be saved. Please, try again.', true));
			}
		}
           
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid tipo', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Tipo->save($this->data)) {
				$this->Session->setFlash(__('Se guardaron los cambios', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The tipo could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Tipo->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for tipo', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Tipo->delete($id)) {
			$this->Session->setFlash(__('Tipo deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Tipo was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
    
    	function admin_options($id = null) {
		if (!$id) {
		exit();
		}
		if (ctype_digit(($id))) {
			$list = $this->Tipo->find('list',array('conditions'=>array('categoria_id'=>$id)));
            
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
