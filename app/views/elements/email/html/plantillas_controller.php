<?php

class PlantillasController extends AppController {


    var $name = 'Plantillas';

	public function admin_index() {
		$this->Plantilla->recursive = 0;
		$this->set('plantillas', $this->paginate());
	}


	public function admin_view($id = null) 
    {
		$this->Plantilla->id = $id;
		if (!$this->Plantilla->exists()) {
			throw new NotFoundException(__('Invalid plantilla'));
		}
		$this->set('plantilla', $this->Plantilla->read(null, $id));
        
        $this->layout='blank';
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {

			if($this->data){            
			if ($this->Plantilla->save($this->data)) {
			 
             
           
             //   App::uses('File', 'Utility');
             
                $fp = fopen('../views/elements/email/html/'.$this->data["Plantilla"]["nombre"].'.ctp','w+');  
                /** remplazo los html especial para que funcione el php*/
                $this->data["Plantilla"]["html"]=str_replace("{{'","<?php echo $",$this->data["Plantilla"]["html"]);
                $this->data["Plantilla"]["html"]=str_replace("'}}",' ?>',$this->data["Plantilla"]["html"]);
                
              //  fwrite ('../views/elements/html/'.$this->data["Plantilla"]["nombre"].'.ctp', $this->data["Plantilla"]["html"]);             
             
             fwrite ($fp,$this->data["Plantilla"]["html"]);
             

				$this->Session->setFlash(__('Plantilla Creada', true));
				$this->redirect(array('action' => 'index'));
			}
             else {
				$this->Session->setFlash(__('The plantilla could not be saved. Please, try again.'));
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
		$this->Plantilla->id = $id;
		if (!$this->Plantilla->exists()) {
			throw new NotFoundException(__('Invalid plantilla'));
		}
		if ($this->data) {
			if ($this->Plantilla->save($this->data)) {
			 
           //     App::uses('File', 'Utility');
  //         print_r($_POST["data"]["Plantilla"]["nombre"]);
//           exit();
            
           
                $file = new File('../views/elements/email/html/'.$_POST["data"]["Plantilla"]["nombre"].'.ctp', true, 0644);
                               
                $plantilla=str_replace("{{'","<?php echo $",$_POST["data"]["Plantilla"]["html"]);
                
                $plantilla=str_replace("'}}",' ?>',$plantilla);
                
                $plantilla=str_replace("{{'","<?php echo $",$plantilla);
                $plantilla=str_replace("{'","<?php echo $",$plantilla);
                $plantilla=str_replace("{","",$plantilla);
                $file->write(( stripcslashes($plantilla)));
                
                $this->Session->setFlash(__('Plantilla Editada', true));
                                
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The plantilla could not be saved. Please, try again.'));
			}
		} else {
			$this->data = $this->Plantilla->read(null, $id);
		}
        
        $this->layout='admin_sin';
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
		if ($this->Plantilla->delete($id)) {
			$this->Session->setFlash(__('Plantilla Borrada', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Mensaje was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}



function admin_image_upload()
{
  
//    $this->Image=$this->Components->load("Image");
    $filename=$this->Image->upload($_FILES['file'],'img/plantillas/');
	$array = array('filelink' =>  $this->webroot.'img/plantillas/'.$filename);	
	echo stripslashes(json_encode($array));   
    exit();
}
    
    

function admin_file_upload()
{
    
   // imageupload
    
}
}
