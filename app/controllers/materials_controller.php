<?php
class MaterialsController extends AppController {

	var $name = 'Materials';

	function admin_index() {
		$this->Material->recursive = 0;
        if(isset($_GET["search"]))
        {
        $this->set('materials',$this->paginate(null,array("{$_POST["criterio"]} like '%{$_POST["like"]}%'")));
        }
        else
		$this->set('materials', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid material', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('material', $this->Material->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Material->create();
			if ($this->Material->save($this->data)) {
			 	$this->Session->setFlash(__('El material fue guardado', true));
			   if($_POST["step"]==utf8_encode('SALVAR Y REGISTRAR OTRO MATERIAL'))
                {$this->redirect(array('action' => 'add')); exit();}
                else
                $this->redirect(array('action' => 'index'));             
             
				$this->Session->setFlash(__('The material has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The material could not be saved. Please, try again.', true));
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid material', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Material->save($this->data)) {
				$this->Session->setFlash(__('El material fue guardado', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The material could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Material->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for material', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Material->delete($id)) {
			$this->Session->setFlash(__('Material deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Material was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
