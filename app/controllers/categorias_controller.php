<?php
class CategoriasController extends AppController {

	var $name = 'Categorias';

	function admin_index() {
		$this->Categoria->recursive = 0;
        if(isset($_GET["search"]))
        {
            $this->set('categorias', $this->paginate(null,array("{$_POST["criterio"]} like '%{$_POST["like"]}%'")));
        }
         else
         $this->set('categorias', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid categoria', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('categoria', $this->Categoria->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Categoria->create();
			if ($this->Categoria->save($this->data)) {
				$this->Session->setFlash(__('La categor&iacute;a fue guardada', true));                
                if($_POST["step"]==utf8_encode('SALVAR Y REGISTRAR OTRA CATEGORÍA'))
                {$this->redirect(array('action' => 'add')); exit();}
                else
                $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The categoria could not be saved. Please, try again.', true));
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid categoria', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Categoria->save($this->data)) {
				$this->Session->setFlash(__('The categoria has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The categoria could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
		 // pr($this->Categoria->read(null, $id));
          
			$this->data = $this->Categoria->read(null, $id);
            
            
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for categoria', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Categoria->delete($id)) {
			$this->Session->setFlash(__('Categoria deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Categoria was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
