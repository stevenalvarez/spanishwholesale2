<?php

class PaginasController extends AppController {


    var $name = 'Paginas';

	public function admin_index() {
		$this->Pagina->recursive = 0;
		$this->set('Paginas', $this->paginate());
	}


	public function admin_view($id = null) 
    {
		$this->Pagina->id = $id;
		if (!$this->Pagina->exists()) {
			throw new NotFoundException(__('Invalid Pagina'));
		}
		$this->set('Pagina', $this->Pagina->read(null, $id));
        
        $this->layout='blank';
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {

			if($this->data){            
			if ($this->Pagina->save($this->data)) {
			 
             
           
             //   App::uses('File', 'Utility');
             
                $fp = fopen('../views/pages/'.$this->data["Pagina"]["nombre"].'.ctp','w+');  
                /** remplazo los html especial para que funcione el php*/
                $this->data["Pagina"]["html"]=str_replace("{{'","<?php echo $",$this->data["Pagina"]["html"]);
                $this->data["Pagina"]["html"]=str_replace("'}}",' ?>',$this->data["Pagina"]["html"]);
                
              //  fwrite ('../views/elements/html/'.$this->data["Pagina"]["nombre"].'.ctp', $this->data["Pagina"]["html"]);             
             
             fwrite ($fp,$this->data["Pagina"]["html"]);
             

				$this->Session->setFlash(__('Pagina Creada', true));
				$this->redirect(array('action' => 'index'));
			}
             else {
				$this->Session->setFlash(__('The Pagina could not be saved. Please, try again.'));
			} }
	
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		$this->Pagina->id = $id;
		if (!$this->Pagina->exists()) {
			throw new NotFoundException(__('Invalid Pagina'));
		}
		if ($this->data) {
			if ($this->Pagina->save($this->data)) {
         //     App::uses('File', 'Utility');
                $file = new File('../views/pages/'.$this->data["Pagina"]["nombre"].'.ctp', true, 0644);
                $Pagina=str_replace("{{'","<?php echo $",$this->data["Pagina"]["html"]);
                $Pagina=str_replace("'}}",' ?>',$Pagina);
                $file->write($Pagina);
                
                $this->Session->setFlash(__('Pagina Editada', true));
                                
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Pagina could not be saved. Please, try again.'));
			}
		} else {
			$this->data = $this->Pagina->read(null, $id);
		}
        
   //     $this->layout='blank';
	}

/**
 * admin_delete method
 *
 * @throws MethodNotAllowedException
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	function admin_delete($id = null) {
       
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for mensaje', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Pagina->delete($id)) {
			$this->Session->setFlash(__('Pagina Borrada', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Mensaje was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}



function admin_image_upload()
{
  
//    $this->Image=$this->Components->load("Image");
    $filename=$this->Image->upload($_FILES['file'],'img/Paginas/');
	$array = array('filelink' =>  $this->webroot.'img/Paginas/'.$filename);	
	echo stripslashes(json_encode($array));   
    exit();
}
    
    

function admin_file_upload()
{
    
   // imageupload
    
}
}
